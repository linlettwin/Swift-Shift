<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Div on Image Click</title>
  <style>

    .navi {
        position: fixed;
        top: 0;
        right: 0;
    }
    /* Initially hide the div */
    .hidden-div {
      display: none;
    }
    
    /* Show the div when it's targeted */
    .hidden-div:target {
      display: block;
      position: absolute; /* Change positioning to absolute */
      top: 56px; /* Place it just below the anchor */
      right: 0;
      width: 350px;
      height: 210px;
      padding: 15px;
      background: rgba(232, 232, 232, 1);
      border-radius: 12px;
      text-align: center;
    }

    .accountIcon{
        max-width: 50px;
        max-height: 50px;
    }

    .accountIconInside{
        width: 80px;
        height: 80px;
    }

    .manage{
        font-size: 14px;
        position: absolute;
        top: 105px;
        width: 250px;
        border-radius: 15px;
        padding: 8px;
        left: 20%;
        border: blue 1px solid;
        outline: none;
        background-color: white;
    }

    .history{
        font-size: 14px;
        position: absolute;
        top: 160px;
        width: 250px;
        left: 20%;
        border: blue 1px solid;
        outline: none;
        background-color: white;
        border-radius: 15px;
        padding: 8px;
    }
  </style>
</head>
<body>

  <!-- Image to click (link to show the div) -->
  <nav class="navi">
    <a href="#hidden-div" class="trigger">
        <img src="account.png" alt="Account" class="accountIcon">
    </a>
  </nav>
  

  <!-- Div to show/hide (targeted by the link) -->
  <div id="hidden-div" class="hidden-div">
    <img src="account.png" alt="Account" class="accountIconInside">
    <button class="manage">Manage your Account</button>
    <button class="history">View your Previous History</button>

  </div>

  <script>
    document.addEventListener('click', function(event) {
      // Check if the clicked element is not the hidden-div or its child
      if (!event.target.closest('#hidden-div')) {
        // Hide the hidden-div
        location.hash = ''; // Clears the fragment identifier
      }
    });
  </script>

</body>
</html>
