fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
    .then(response => response.json())
    .then(estados => {
      const estadoSelect = document.getElementById('estado');
      estados.forEach(estado => {
        const option = document.createElement('option');
        option.value = estado.sigla; // Para mostrar a sigla como valor
        option.textContent = estado.nome;
        option.setAttribute('data-uf', estado.id); // Adiciona o ID da UF para a busca de municípios
        estadoSelect.appendChild(option);
      });
    });

  // Carregar municípios com base no estado selecionado
  document.getElementById('estado').addEventListener('change', function () {
    const uf = this.options[this.selectedIndex].getAttribute('data-uf');
    const municipioSelect = document.getElementById('municipio');
    municipioSelect.innerHTML = '<option value="">Selecione um município</option>';

    if (uf) {
      fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
        .then(response => response.json())
        .then(municipios => {
          municipios.forEach(municipio => {
            const option = document.createElement('option');
            option.value = municipio.nome;
            option.textContent = municipio.nome;
            municipioSelect.appendChild(option);
          });
        });
    }
  });