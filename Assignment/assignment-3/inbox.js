document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from fetch.php
    fetch('fetch.php')
        .then(response => response.json())
        .then(data => {
            
            const inboxPeople = document.getElementById('inboxPeople');
            const inboxMessage = document.getElementById('inboxMessage');

            data.forEach(contact => {
                const nameButton = document.createElement('button');
                nameButton.textContent = contact.name;
                nameButton.classList.add('btn', 'btn-primary', 'm-2');

                
                nameButton.addEventListener('click', function () {
                
                    inboxMessage.textContent = contact.message;
    
                });

                inboxPeople.appendChild(nameButton);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
