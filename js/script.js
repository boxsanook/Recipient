function filterData_province() {
    var provinceId = document.getElementById('province').value;

    // Send an AJAX request to the server-side script
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            updateSelectOptions('district', response.districts);
            updateSelectOptions('subdistrict', response.subdistricts);
            updateSelectOptions('zip-code', response.zipCodes);
        }
    };
    xhttp.open('POST', 'filter_data.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('provinceId=' + provinceId);
}

function updateSelectOptions(selectId, options) {
    var selectElement = document.getElementById(selectId);
    selectElement.innerHTML = '';

    var defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Select ' + selectId.charAt(0).toUpperCase() + selectId.slice(1);
    selectElement.appendChild(defaultOption);

    options.forEach(function (option) {
        var newOption = document.createElement('option');
        newOption.value = option.id;
        newOption.text = option.name; // Display the name property of the option
        selectElement.appendChild(newOption);
    });

    set_default(selectId)
}

function filterData_district() {
    var provinceId = document.getElementById('province').value;
    var districtId = document.getElementById('district').value;

    // Send an AJAX request to the server-side script
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            // updateSelectOptions('district', response.districts);
            updateSelectOptions('subdistrict', response.subdistricts);
            updateSelectOptions('zip-code', response.zipCodes);
        }
    };
    xhttp.open('POST', 'filter_data.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var data = 'provinceId=' + provinceId + '&districtId=' + districtId;
    xhttp.send(data);
}


function filterData_subdistrict() {
    var provinceId = document.getElementById('province').value;
    var districtId = document.getElementById('district').value;
    var subdistrictId = document.getElementById('subdistrict').value;
    // Send an AJAX request to the server-side script
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            // updateSelectOptions('district', response.districts);
            // updateSelectOptions('subdistrict', response.subdistricts);
            updateSelectOptions('zip-code', response.zipCodes);
        }
    };
    xhttp.open('POST', 'filter_data.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var data = 'provinceId=' + provinceId + '&districtId=' + districtId + '&subdistrictId=' + subdistrictId;
    xhttp.send(data);
}


function set_default(selectId) {
    var selectElement = document.getElementById(selectId);
    var optionCount = selectElement.options.length;
    // Set the default option if no other option is selected
    if (!selectElement.value && optionCount > 0) {
        selectElement.value = selectElement.options[1].value;
    }
}