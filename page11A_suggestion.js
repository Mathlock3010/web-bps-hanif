function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        filterTable([]);
        return;
    }
    
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        // Periksa readystate dan status
        if (this.readyState == 4 && this.status == 200) {
            
            var responseData = JSON.parse(this.responseText);
            var hintString = "";
            
            for (var i = 0; i < responseData.length; i++) {
                if (hintString === "") {
                    hintString = responseData[i].judul;
                } else {
                    hintString += ", " + responseData[i].judul;
                }
            }
            
            document.getElementById("txtHint").innerHTML = hintString;
            filterTable(responseData);
        }
    };
    
    xhttp.open("GET", "page11A_gethint.php?keyword=" + encodeURIComponent(str), true);
    xhttp.send();
}

function filterTable(responseData) {
    var matchingTitles = responseData.map(function(item) {
        return item.judul.toLowerCase();
    });
    var tableRows = document.querySelectorAll("#tabelPublikasi tr:not(#Header)");

    tableRows.forEach(function(row) {
        if (row.cells.length < 2) {
            return;
        }

        var title = row.cells[1].textContent.trim().toLowerCase();
        row.style.display = matchingTitles.length === 0 || matchingTitles.indexOf(title) !== -1
            ? ""
            : "none";
    });
}