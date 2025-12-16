document.addEventListener('DOMContentLoaded', () => {
    
    const campoSelect = document.getElementById('campo_select');
    const duracaoSelect = document.getElementById('duracao_select');
    const timeSlots = document.querySelectorAll('.time-slot');
    const selectedTimeInput = document.getElementById('selected_time');
    const dataInput = document.getElementById('data_jogo');

    const resumoImg = document.getElementById('resumo_img');
    const resumoNome = document.getElementById('resumo_nome');
    const resumoLocal = document.getElementById('resumo_local');
    const resumoPreco = document.getElementById('resumo_preco');
    const resumoDataDisplay = document.getElementById('resumo_data_display');
    const resumoDuracao = document.getElementById('resumo_duracao');
    const resumoHora = document.getElementById('resumo_hora');
    const msgPagamento = document.getElementById('msg_pagamento');
    const msgFecho = document.getElementById('msg_fecho');

    const form = document.getElementById('form-reserva');
    const timeErrorMessage = document.getElementById('time-error-message');
    const errorText = document.getElementById('error-text');
    const submitErrorMessage = document.getElementById('submit-error-message');

    let horaFechoAtual = 20; 
    let horasOcupadas = []; 


    function limparSelecaoVisual() {
        timeSlots.forEach(btn => {
            if (!btn.classList.contains('ocupado')) {
                btn.className = "time-slot py-2 px-4 rounded-lg border border-gray-200 text-gray-600 bg-white hover:bg-green-50 hover:border-green-500 hover:text-green-700 transition text-sm font-bold w-full";
            }
        });
    }

    function ativarBotao(btn) {
        btn.classList.remove('text-gray-600', 'border-gray-200', 'bg-white', 'hover:bg-green-50', 'hover:text-green-700', 'hover:border-green-500');
        btn.classList.add('bg-green-600', 'text-white', 'border-transparent');
    }

    function marcarErro(btn) {
        btn.classList.remove('text-gray-600', 'border-gray-200', 'bg-white', 'hover:bg-green-50', 'bg-green-600');
        btn.classList.add('bg-red-500', 'text-white', 'border-red-500', 'hover:bg-red-600');
    }

    function atualizarEstadoBotoes() {
        const option = campoSelect.options[campoSelect.selectedIndex];
        horaFechoAtual = parseInt(option.getAttribute('data-fecho'));
        const temData = dataInput.value !== "";

        timeSlots.forEach(btn => {
            const horaInt = parseInt(btn.getAttribute('data-hora-int'));
            const horaTexto = btn.getAttribute('data-time');

            btn.className = "time-slot py-2 px-4 rounded-lg border border-gray-200 text-gray-600 bg-white hover:bg-green-50 hover:border-green-500 hover:text-green-700 transition text-sm font-bold w-full";
            btn.disabled = false;

            if (horaInt >= horaFechoAtual) {
                btn.style.display = 'none';
                return;
            } else {
                btn.style.display = 'block';
            }

            if (!temData) {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                return;
            }

            if (horasOcupadas.includes(horaTexto)) {
                btn.className = "time-slot py-2 px-4 rounded-lg border border-gray-200 text-gray-400 bg-gray-50 cursor-not-allowed line-through decoration-2 decoration-red-500 ocupado w-full";
                btn.disabled = true;
            }
        });

        if (msgFecho) {
            msgFecho.textContent = `Nota: Este campo encerra às ${horaFechoAtual}:00.`;
            msgFecho.classList.remove('hidden');
        }
    }

    function atualizarResumo() {
        const option = campoSelect.options[campoSelect.selectedIndex];
        
        if(resumoImg) resumoImg.src = option.getAttribute('data-img');
        if(resumoNome) resumoNome.textContent = option.text.split('(')[0];
        if(resumoLocal) resumoLocal.textContent = option.getAttribute('data-local');

        const precoHora = parseFloat(option.getAttribute('data-preco')); 
        const horas = parseInt(duracaoSelect.value); 
        const total = precoHora * horas;

        if(resumoDuracao) resumoDuracao.textContent = horas + (horas === 1 ? ' Hora' : ' Horas');

        if(resumoPreco) {
            if (total === 0) {
                resumoPreco.textContent = "Gratuito";
                resumoPreco.className = "text-2xl font-bold text-green-600";
                msgPagamento.textContent = "Reserva gratuita.";
            } else {
                resumoPreco.textContent = total.toFixed(2).replace('.', ',') + '€';
                resumoPreco.className = "text-2xl font-bold text-gray-800";
                msgPagamento.textContent = "Pagamento no local.";
            }
        }
    }

    function verificarDisponibilidadeAJAX() {
        const campoId = campoSelect.value;
        const dataJogo = dataInput.value;

        selectedTimeInput.value = "";
        if(resumoHora) resumoHora.textContent = "--:--";
        
        if (!dataJogo) {
            atualizarEstadoBotoes();
            return;
        }

        fetch(`ajax/verificar_reservas.php?campo_id=${campoId}&data_jogo=${dataJogo}`)
            .then(response => response.json())
            .then(ocupadas => {
                horasOcupadas = ocupadas;
                atualizarEstadoBotoes();
            })
            .catch(err => console.error('Erro AJAX:', err));
    }

    campoSelect.addEventListener('change', () => {
        atualizarResumo();
        verificarDisponibilidadeAJAX(); 
    });

    duracaoSelect.addEventListener('change', () => {
        atualizarResumo();
        selectedTimeInput.value = "";
        if(resumoHora) resumoHora.textContent = "--:--";
        atualizarEstadoBotoes();
    });

    dataInput.addEventListener('change', (e) => {
        const date = new Date(e.target.value);
        if(!isNaN(date)) {
            if(resumoDataDisplay) resumoDataDisplay.textContent = date.toLocaleDateString('pt-PT');
            verificarDisponibilidadeAJAX();
        }
    });

    timeSlots.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            if (btn.disabled || btn.classList.contains('ocupado')) return;

            limparSelecaoVisual();
            timeErrorMessage.classList.add('hidden');
            submitErrorMessage.classList.add('hidden');

            const duracao = parseInt(duracaoSelect.value);
            const horaInicio = parseInt(btn.getAttribute('data-hora-int'));
            
            if (horaInicio + duracao > horaFechoAtual) {
                marcarErro(btn);
                errorText.textContent = `O campo fecha às ${horaFechoAtual}:00.`;
                timeErrorMessage.classList.remove('hidden');
                return;
            }

            if (duracao === 2) {
                const nextBtn = timeSlots[index + 1];
                if (!nextBtn || nextBtn.style.display === 'none' || nextBtn.classList.contains('ocupado')) {
                    marcarErro(btn);
                    errorText.textContent = `Horário seguinte indisponível.`;
                    timeErrorMessage.classList.remove('hidden');
                    return;
                }
                ativarBotao(btn);
                ativarBotao(nextBtn);
            } else {
                ativarBotao(btn);
            }

            const time = btn.getAttribute('data-time');
            selectedTimeInput.value = time;
            if(resumoHora) resumoHora.textContent = time;
        });
    });

    form.addEventListener('submit', (e) => {
        if (selectedTimeInput.value === "") {
            e.preventDefault(); 
            submitErrorMessage.classList.remove('hidden'); 
        }
    });

    atualizarResumo();
    setTimeout(() => {
        verificarDisponibilidadeAJAX();
    }, 50);

});