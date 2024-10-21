    document.getElementById('imagem').addEventListener('change', function(event) {
        
        const iconeDeUploadImagem = document.getElementsByClassName('iconeUpload');
        const file = event.target.files[0]; // Pega o primeiro arquivo.

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {

                // Atualiza o src da imagem de pré-visualização.
                document.getElementById('imagemPreview').src = e.target.result;

                // Remove o icone que representa o upload de um arquivo no input de carregar a imagem do produto: "+".
                iconeDeUploadImagem[0].style.display = "none";

            }

            reader.readAsDataURL(file); // Lê o arquivo como URL.

        }

    });
