function atualizarNomeArquivo(input) {
    if (input.files.length > 0) {
        const fileName = input.files[0].name;
        document.getElementById('nome_arquivo').textContent = fileName;
        document.getElementById('display_nome_arquivo').classList.remove('hidden');
        
        document.getElementById('label_upload_arquivo').innerHTML = `
            <div class="text-green-500 mb-4 text-5xl">
                <i class="fas fa-check-circle"></i>
            </div>
            <p class="text-gray-700 font-medium text-center text-lg">
                Arquivo selecionado:
            </p>
            <p class="font-semibold text-green-600 truncate max-w-full text-lg">${fileName}</p>
            <p class="text-gray-500 text-md mt-4">
                <span class="underline text-purple-600 cursor-pointer">Clique para alterar</span>
            </p>
        `;
        
        document.getElementById('label_upload_arquivo').htmlFor = 'imagem';
    } else {
        document.getElementById('display_nome_arquivo').classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('filmeModal');
    const fechar_modalBtn = document.getElementById('fechar_modal');
    const gatilhos = document.querySelectorAll('.gatilho_modal');
    
    function openModal(gatilho) {
        const titulo = gatilho.getAttribute('data-titulo');
        const sinopse = gatilho.getAttribute('data-sinopse');
        const ano = gatilho.getAttribute('data-ano');
        const capa = gatilho.getAttribute('data-capa');
        const link = gatilho.getAttribute('data-link');
        const categoria = gatilho.getAttribute('data-categoria');
        
        document.getElementById('modalTitulo').textContent = titulo;
        document.getElementById('modalSinopse').textContent = sinopse;
        document.getElementById('modalAno').textContent = ano;
        document.getElementById('modalCapa').src = capa;
        document.getElementById('modalCapa').alt = `Capa de ${titulo}`;
        document.getElementById('modalLink').href = link;
        document.getElementById('modalCategoria').textContent = categoria;
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function fechar_modal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    gatilhos.forEach(gatilho => {
        gatilho.addEventListener('click', function() {
            openModal(this);
        });
    });
    
    fechar_modalBtn.addEventListener('click', fechar_modal);
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            fechar_modal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            fechar_modal();
        }
    });
});