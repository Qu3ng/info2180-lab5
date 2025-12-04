document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('lookup').addEventListener('click', function() {
        let country = document.getElementById('country').value;
        let url = 'world.php?country=' + encodeURIComponent(country);
        
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('result').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});