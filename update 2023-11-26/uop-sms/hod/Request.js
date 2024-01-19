function displaySelectedField() {
    var selectElement = document.getElementById("requestField");
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
  
    var display = document.getElementById("requestValue");
    display.innerHTML = ''; // Clear existing options
  
    // Fetch data asynchronously using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var data = JSON.parse(xhr.responseText);
  
        // Populate options based on the fetched data
        for (var i = 0; i < data.length; i++) {
          var option = document.createElement("option");
  
          // Adjust the field name based on the selected value
          if (selectedValue == "type_name") {
            option.value = data[i].id;
            option.text = data[i].type_name;
          } else if (selectedValue == "title") {
            option.value = data[i].id;
            option.text = data[i].title_name;
          }
          else if (selectedValue == "designation") {
            option.value = data[i].id;
            option.text = data[i].designation_name;
          }
          else if (selectedValue == "faculty") {
            option.value = data[i].id;
            option.text = data[i].faculty_name;
          }
          else if (selectedValue == "department") {
            option.value = data[i].id;
            option.text = data[i].department_name;
          }
  
          display.add(option);
        }
      }
    };
  
    // Adjust the field parameter and URL based on the selected value
    var fieldParam, url;
    if (selectedValue == "type_name") {
      fieldParam = "type_name";
      url = "fetch_data.php?field=" + fieldParam;
    } else if (selectedValue == "title") {
      fieldParam = "title";
      url = "fetch_data.php?field=" + fieldParam;
    }
    else if (selectedValue == "designation") {
      fieldParam = "designation";
      url = "fetch_data.php?field=" + fieldParam;
    }
    else if (selectedValue == "faculty") {
      fieldParam = "faculty";
      url = "fetch_data.php?field=" + fieldParam;
    }
    else if (selectedValue == "department") {
      fieldParam = "department";
      url = "fetch_data.php?field=" + fieldParam;
    }
  
    xhr.open("GET", url, true);
    xhr.send();
  }
  