<?php
class Controller
{
    const VIEW_FOLDER_NAME = 'views';
    const MODEL_FOLDER_NAME = 'models';
    protected function view($view_path, array $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        require_once './app/' . self::VIEW_FOLDER_NAME . '/' . $view_path . '.php';
    }
    protected function loadModel($model_path)
    {
        include_once './app/' . self::MODEL_FOLDER_NAME . '/' . $model_path . '.php';
    }
}
