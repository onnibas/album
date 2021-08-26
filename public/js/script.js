/*
-------------MODAL-------------
*/
//variável que recebe o elemento HTML(modal)
var confirmationModal = document.getElementById('confirmationModal')

//adiciona um evento toda vez que o modal for aberto
confirmationModal.addEventListener('show.bs.modal', function (event) {

  //variável que recebe o botão que acionou o modal
  var button = event.relatedTarget

  //variável que recebe o formulário do modal
  var form = document.getElementById('formDeletePhoto')

  //alterando o action(rota) do formulário
  form.action = "/photos/" + button.getAttribute('data-photo-id')
})

/*
---------CARREGAR IMG---------
*/
function loadFile(event) {
  //variável que recebe o elemento img
  var imgPrev = document.getElementById('imgPrev')

  //Link para a Imagem
  var url = URL.createObjectURL(event.target.files[0])

  //altera a propriedade src para o link da imagem
  imgPrev.src = url
}
