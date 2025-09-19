<?php

namespace App\Http\Controllers;

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

        Storage::disk('public')->put('file1.txt', 'Conteudo do ficheiro 1'); // com o public ele fica disponivel ao public (sem esse disk, porem nesse codigo atual meu n estava dando certo)
        Storage::disk('public')->put('file2.txt', 'Conteudo do ficheiro 2');

        echo "Fim!";
    }

    public function storageLocalAppend()
    {
        // Storage:append('file3.txt', Str::random(100)); --> jeito que não funciona nesse meu codigo
        // Storage::disk('local')->append('file3.txt', Str::random(100));  --> outro jeito de fazer que tbm não da certo

        Storage::disk('public')->append('file3.txt', Str::random(100)); // --> jeito q da certo

        return redirect()->route('home');
    }

    public function storageLocalRead()
    {
        $content = Storage::disk('public')->get('file1.txt');
        // $content = Storage::disk('local')->get('file1.txt');
        echo $content;
    }

    public function storageLocalReadMulti()
    {
        $lines = Storage::disk('public')->get('file3.txt');
        $lines = explode(PHP_EOL, $lines);

        foreach ($lines as $line) {
            echo "<p>$line</p>";
        }
    }

    public function storageLocalCheckFile()
    {
        $exists = Storage::disk('public')->exists('file1.txt');
        //ou $exists = Storage::disk('local')->exists('file1.txt');

        // if (Storage::disk('public')->exists('file1.txt')) ==> da para fazer assim tbm
        if ($exists) {
            echo 'O ficheio existe';
        } else {
            echo 'O ficheio não existe';
        }

        // so uma forma de que da para manipular(a view) desse arquivo sem muito trabalho
        // echo '<br>';
        // if (Storage::disk('public')->missing('file100.txt')) {
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

        Storage::disk('public')->put('data.json', json_encode($data));
        echo 'Ficheiro JSON criado';
    }

    public function readJSON()
    {
        $data = Storage::disk('public')->json('data.json');
        echo '<pre>';
        print_r($data);
    }
}
