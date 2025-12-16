document.addEventListener('DOMContentLoaded', function() {

    const diaSelect = document.getElementById('birth_day');
    if (diaSelect) {
        for (let i = 1; i <= 31; i++) {
            let option = document.createElement('option');
            option.value = i;
            option.text = i;
            diaSelect.appendChild(option);
        }
    }

    const mesSelect = document.getElementById('birth_month');
    if (mesSelect) {
        const meses = [
            "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
            "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
        ];
        
        meses.forEach((mes, index) => {
            let option = document.createElement('option');
            option.value = index + 1; 
            option.text = mes; 
            mesSelect.appendChild(option);
        });
    }

    const anoSelect = document.getElementById('birth_year');
    if (anoSelect) {
        const anoAtual = new Date().getFullYear();
        const anoMinimo = anoAtual - 100; 

        for (let i = anoAtual; i >= anoMinimo; i--) {
            let option = document.createElement('option');
            option.value = i;
            option.text = i;
            anoSelect.appendChild(option);
        }
    }

    const emailInput = document.querySelector('input[name="email"]');
    
    let msgErro = document.createElement('p');
    msgErro.className = "text-red-500 text-xs mt-1 font-bold hidden";
    msgErro.innerText = "Este e-mail já está registado.";
    
    if (emailInput) {
        emailInput.parentNode.appendChild(msgErro);

        emailInput.addEventListener('blur', function() {
            const email = this.value;

            if (email.length > 0) {
                const formData = new FormData();
                formData.append('email', email);

                fetch('ajax/verificar_email.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.existe) {
                        emailInput.classList.add('border-red-500');
                        emailInput.classList.remove('focus:border-green-600'); 
                        msgErro.classList.remove('hidden');
                    } else {
                        emailInput.classList.remove('border-red-500');
                        emailInput.classList.add('focus:border-green-600');
                        msgErro.classList.add('hidden');
                    }
                })
                .catch(err => console.error('Erro:', err));
            }
        });
    }
});