    console.log("Teste");    
    
    
    document.getElementById('imagem').addEventListener('change', function(event) {
        
        const iconUpload = document.getElementsByClassName('iconeUpload');
        const file = event.target.files[0]; // Pega o primeiro arquivo.

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {

                // Atualiza o src da imagem de pré-visualização
                document.getElementById('imagemPreview').src = e.target.result;

                // Remove o icone que representa o upload de um arquivo no input de carregar a imagem do produto: "+".
                iconUpload[0].style.display = "none";

            }

            reader.readAsDataURL(file); // Lê o arquivo como URL.

        }

    });



    const inputValorProduto = document.getElementById('valorProduto');

    inputValorProduto.addEventListener('input', function() {
        // Permite que o usuário digite, mas só armazena números
        let value = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
        this.value = value; // Atualiza o campo de entrada com apenas números
    });

    inputValorProduto.addEventListener('blur', function() {
        // Formata o valor quando o campo perde o foco
        let value = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos

        if (value) {
            // Converte a string para um número e divide por 100
            value = (parseInt(value) / 100).toFixed(2);
            // Adiciona o símbolo de moeda e formata
            this.value = 'R$ ' + value.replace('.', ',');
        } else {
            this.value = ''; // Limpa o campo se não houver valor
        }
    });

    inputValorProduto.addEventListener('focus', function() {
        // Remove o símbolo de moeda ao focar no input
        if (this.value) {
            // Remove "R$ " e formata o número para que o usuário possa editar
            this.value = this.value.replace('R$ ', '').replace('.', '').replace(',', '');
        }
    });