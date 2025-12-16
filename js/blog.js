document.addEventListener('DOMContentLoaded', function() {
    
    const formNewsletter = document.getElementById('form-newsletter');

    if (formNewsletter) {
        
        formNewsletter.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            const emailInput = document.getElementById('news_email');
            const feedback = document.getElementById('news_feedback');
            const btn = this.querySelector('button');
            const email = emailInput.value;

            btn.disabled = true;
            btn.textContent = '...';

            const formData = new FormData();
            formData.append('email', email);

            fetch('ajax/subscrever_newsletter.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                feedback.classList.remove('hidden');
                
                if (data.status === 'success') {
                    feedback.className = "text-sm mt-4 font-bold text-green-400";
                    feedback.textContent = data.message;
                    emailInput.value = ""; 
                } else {
                    feedback.className = "text-sm mt-4 font-bold text-red-400";
                    feedback.textContent = data.message;
                }
            })
            .catch(err => {
                console.error(err);
                feedback.classList.remove('hidden');
                feedback.className = "text-sm mt-4 font-bold text-red-400";
                feedback.textContent = "Erro de ligação ao servidor.";
            })
            .finally(() => {
                btn.disabled = false;
                btn.textContent = 'Subscrever';
                
                setTimeout(() => {
                    feedback.classList.add('hidden');
                }, 5000);
            });
        });
    }
});