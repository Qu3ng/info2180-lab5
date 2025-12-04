document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('lookup').addEventListener('click', function() {
        performLookup('country');
    });
    
    document.getElementById('lookupCities').addEventListener('click', function() {
        performLookup('cities');
    });
    
    document.getElementById('country').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            performLookup('country');
        }
    });
    
    function performLookup(type) {
        let country = document.getElementById('country').value;
        let url = 'world.php?country=' + encodeURIComponent(country);
        
        if (type === 'cities') {
            url += '&lookup=cities';
        }
        
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('result').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});