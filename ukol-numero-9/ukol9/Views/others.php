<!doctype html>
<html lang="en">

<head>
  <title>Others</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap.css">
  <link rel="stylesheet" href="./bootstrap-icons.css">
</head>

<style>
  /* some hacks for responsive sidebar */
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    padding: 48px 0 0;
    /* height of navbar */
  }

  .sidebar-sticky {
    height: calc(100vh - 48px);
    overflow-x: hidden;
    overflow-y: auto;
  }
</style>

<body>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3 pb-3">
    <h1>Others</h1>
    <div id="json-container"></div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./bootstrap.js"></script>

  <script>
    function loadUsers() {
      fetch('https://localhost/ukol7/api.php/get')
        .then(response => response.json())
        .then(jsonObject => {
          displayJSON(jsonObject);
        })
        .catch(error => console.error('Error loading users:', error));
    }

    function displayJSON(jsonObject) {
      let jsonContainer = document.getElementById('json-container');
      jsonContainer.innerHTML = '';
      let pre = document.createElement('table');
      pre.textContent = JSON.stringify(jsonObject, null, 2);
      jsonContainer.appendChild(pre);
    }

    function addUser() {
      const userData = {
        id: '2',
        name: 'Petr',
        surname: 'Novak'
      };

      fetch('https://localhost/ukol7/api.php/post', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams(userData)
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          loadUsers();
        })
        .catch(error => console.error('Error adding user:', error));
    }
    document.addEventListener('DOMContentLoaded', loadUsers);
    addUser();
  </script>
</body>

</html>