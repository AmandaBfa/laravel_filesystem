<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function storageLocalCreate()
    {
        // Storage::put('file2.txt', 'Conteudo do ficheiro 2'); esse é o codigo que nao deu certo, não roda
        // Storage::disk('local')->put('file2.txt', 'Conteudo do ficheiro 2'); outro que não deu certo, apenas os de baixo que dão certo

        Storage::put('file1.txt', 'Conteudo do ficheiro 1'); // com o public ele fica disponivel ao public (sem esse disk, porem nesse codigo atual meu n estava dando certo)
        Storage::put('file2.txt', 'Conteudo do ficheiro 2');

        echo "Fim!";
    }

    public function storageLocalAppend()
    {
        // Storage:append('file3.txt', Str::random(100)); --> jeito que não funciona nesse meu codigo
        // Storage::disk('local')->append('file3.txt', Str::random(100));  --> outro jeito de fazer que tbm não da certo

        Storage::append('file3.txt', Str::random(100)); // --> jeito q da certo

        return redirect()->route('home');
    }

    public function storageLocalRead()
    {
        $content = Storage::get('file1.txt');
        // $content = Storage::disk('local')->get('file1.txt');
        echo $content;
    }

    public function storageLocalReadMulti()
    {
        $lines = Storage::get('file3.txt');
        $lines = explode(PHP_EOL, $lines);

        foreach ($lines as $line) {
            echo "<p>$line</p>";
        }
    }

    public function storageLocalCheckFile()
    {
        $exists = Storage::exists('file1.txt');
        //ou $exists = Storage::disk('local')->exists('file1.txt');

        // if (Storage::exists('file1.txt')) ==> da para fazer assim tbm
        if ($exists) {
            echo 'O ficheio existe';
        } else {
            echo 'O ficheio não existe';
        }

        // so uma forma de que da para manipular(a view) desse arquivo sem muito trabalho
        // echo '<br>';
        // if (Storage::missing('file100.txt')) {
        //     echo 'O ficheio não existe';
        // } else {
        //     echo 'O ficheio existe';
        // }
    }

    public function storeJSON()
    {
        $data = [
            [
                'name' => 'joao',
                'email' => 'joao@gmail.com'
            ],
            [
                'name' => 'ana',
                'email' => 'ana@gmail.com'
            ],
            [
                'name' => 'carlos',
                'email' => 'carlos@gmail.com'
            ]
        ];

        Storage::put('data.json', json_encode($data));
        echo 'Ficheiro JSON criado';
    }

    public function readJSON()
    {
        $data = Storage::json('data.json');
        echo '<pre>';
        print_r($data);
    }

    public function listFiles()
    {
        $files = Storage::files(null, true);

        // TODOS ESSES ERAM PARA ESTAREM FUNCIONANDO -> AULA 373
        // $files = Storage::files(null, true); --> esse era para estar aparecendo as outras pastas dentro da pasta public 
        // $files = Storage::directories();
        // $files = Storage::files('meus_arquivos');
        // $files = Storage::disk('local')->files();

        echo '<pre>';
        print_r($files);
    }

    public function deleteFiles()
    {
        Storage::delete('file1.txt');
        echo 'Ficheiro removido com sucesso.';

        // delete all files
        // Storage::delete(Storage::files()); ==> metodo que apaga todos os arquivos que estao no storage
    }

    public function createFolder()
    {
        // novamente, esse disk('public') so serve pq nesse meu codigo, os comandos não estão encontrando o caminho correto, que é a pasta public!! mas tem alguma auteração que apos ela não precisa
        Storage::makeDirectory('documents');
        Storage::makeDirectory('documents/teste');
    }

    public function deleteFolder()
    {
        Storage::deleteDirectory('documents');
    }

    public function listFilesWithMetadata()
    {
        $list_files = Storage::allFiles();

        $files = [];

        foreach ($list_files as $file) {

            $files[] = [
                'name' => $file,
                'size' => round(Storage::size($file) / 1024, 2) . 'Kb',
                'last_modified' => Carbon::createFromTimestamp(Storage::lastModified($file))->format('d-m-Y H:i:s'),
                'mime_type' => Storage::mimeType($file)
            ];
        }

        return view('list-files-with-metadata', compact('files'));
    }
}
