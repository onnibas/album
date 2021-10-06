<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('/pages/home', ['photos'=>$photos]);
    }

    public function showAll(){
      $photos = Photo::all();
      return view('/pages/photo_list',['photos' => $photos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/photo_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //criação de um objeto tipo Photo
      $photo = new Photo();

      //alterando os atributos do objeto
      $photo->title = $request->title;
      $photo->date = $request->date;
      $photo->description = $request->description;

      //upload da foto
      if ($request->hasFile('photo') && $request->File('photo')->isValid()) {
        //salvando o caminho completo em uma variavel
        $upload = $this->uploadPhoto($request->photo);
        //dividindo a string em um array
        $directoryArray = explode(DIRECTORY_SEPARATOR,$upload);
        //adicionando nome do arquivo no campo 'photo_url' bd
        $photo->photo_url = $directoryArray[count($directoryArray)-1];
      }

      if($directoryArray){
        //inserindo no banco de dados
        $photo->save();
      }

      //redirecionar para a tela principal
      return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('pages/photo_form',['photo'=>$photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($request->id);

        $photo->title = $request->title;
        $photo->date = $request->date;
        $photo->description = $request->description;

        if ($request->hasFile('photo') && $request->File('photo')->isValid()) {
          //excluir a foto antiga
          $this->deletePhoto($photo->photo_url);

          //realizar upload da nova foto
          //salvando o caminho completo em uma variável
          $upload = $this->uploadPhoto($request->photo);
          //dividindo a string em um array
          $directoryArray = explode(DIRECTORY_SEPARATOR,$upload);
          //adicionando o nome do arquivo em um atributo photo_url
          $photo->photo_url = end($directoryArray);

          if ($directoryArray){
            //alterando no banco
            $photo->update();
          }

          //alterando no bd
          $photo->update();

          //retornando para a página de fotos
          return redirect('/photos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //retornar a foto
      $photo = Photo::findOrFail($id);

      //excluir foto do armazenamento
      $this->deletePhoto($photo->photo_url);

      //excluir foto do bd
      $photo->delete();

      //redireciona para a lista de fotos
      return redirect('/photos');
    }

    public function uploadPhoto($photo){
      //definindo um nome aleatório para a foto, com base na data do upload
      $nomeFoto = sha1(uniqid(date('HisYmd')));

      //recuperando a extensão do arquivo
      $extensao = $photo->extension();

      //definindo o nome do arquivo, com a extensão
      $nomeArquivo = "$nomeFoto.$extensao";

      //fazendo o upload
      $upload = $photo->move(public_path('storage'.DIRECTORY_SEPARATOR.'photos'),$nomeArquivo);

      return $upload;
    }

    public function deletePhoto($fileName){
      if (file_exists(public_path('storage'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.$fileName))) {
        unlink(public_path('storage'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.$fileName));
      }
    }
}
