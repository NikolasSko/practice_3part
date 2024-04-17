<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\Departments;
use Model\Disciplines;
use Model\Teachers;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;
use search\TeachersSearch;


class Site
{

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }


    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup');
    }


    public function add(Request $request): string
    {
        // Проверяем, была ли отправлена форма
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'lastname' => ['required'],
                'firstname' => ['required'],
                'patronymic' => ['required'],
                'gender' => ['required'],
                'age' => ['required'],
                'place' => ['required'],
                'job' => ['required'],
                'img' => []
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);
            if($validator->fails()){
                return new View('site.add',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            // Проверяем, было ли загружено изображение
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                // Путь для сохранения изображения

                $target_dir = "/srv/users/hmtrbncv/hnsgunc-m3/pop-it-mvc/public/image/";;
                $target_file = $target_dir . basename($_FILES['img']['name']);

                // Перемещаем загруженное изображение в указанную директорию
                if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                    echo "Изображение успешно загружено.";
                    // Получаем путь к загруженному изображению
                    $img_path = $_FILES['img']['name'];
                } else {
                    echo "Ошибка при загрузке изображения.";
                }
            } else {
                echo "Изображение не было загружено.";
            }

            // Добавляем путь к изображению к данным о преподавателе
            $teacherData = $request->all();
            $teacherData['img'] = $img_path ?? null; // Добавляем путь к изображению, если он был загружен

            // Попытка создания записи о преподавателе и сохранения пути к изображению в базе данных
            if (Teachers::create($teacherData)) {
                return new View('site.add', ['message' => 'Преподаватель успешно добавлен']);
            } else {
                return new View('site.add', ['message' => 'Ошибка при добавлении преподавателя']);
            }
        }

        return new View('site.add');
    }

//"/srv/users/exfbiggp/ceinizh-m3/pop-it-mvc/public/img/";

    public function index(Request $request): string
    {
        $posts = teachers::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }


    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function teachers(): string
    {
        $teachers = Teachers::all();
        return (new View())->render('site.teachers', ['teachers' => $teachers]);
    }



    public function disciplines(): string
    {
        $disciplines = Disciplines::all();

        return (new View())->render('site.disciplines', ['disciplines' => $disciplines]);
    }
    public function departments(): string
    {
        $departments = Departments::all();
        return (new View())->render('site.departments', ['departments' => $departments]);
    }

    public function add_discipline(Request $request): string
    {
        if ($request->method==='POST' && Disciplines::create($request->all())){
            $validator = new Validator($request->all(), [
                'name' => ['required'],

            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);
            if($validator->fails()){
                return new View('site.add_discipline',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            return new View('site.add_discipline', ['message'=>'Кафедра успешно добавлена']);
        }
        $disciplines = Disciplines::all();
        $departments = Departments::all();
        return new View('site.add_discipline', ['departments'=>$departments, 'disciplines'=>$disciplines]);
    }

    public function add_departments(Request $request): string
    {
        if ($request->method==='POST' && Departments::create($request->all())){
            $validator = new Validator($request->all(), [
                'name' => ['required'],

            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);
            if($validator->fails()){
                return new View('site.add_departments',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            return new View('site.add_departments', ['message'=>'Кафедра успешно добавлена']);
        }
        return new View('site.add_departments');
    }

    public function SearchTeachers(Request $request): string
    {
        $teachers = Teachers::all();

        if ($request->method === 'POST' && isset($_POST['search_query'])) {
            $search_query = $_POST['search_query'];
            $searchableFields =['name','surname','patronymic'];
            $query = Teachers::query();
            if (!empty($search_query)) {
                $teachers = TeachersSearch::search($query, $search_query,$searchableFields);
            }
        }

        return new View('site.SearchTeachers', ['teachers' => $teachers]);


    }



}
