function displayBox() {
    // Create a div element
    var box = document.createElement('div');

    // Add text content to the box
    var message = document.createElement('div');
    message.textContent = "Payment received! Thank you for purchasing from SwiftShift";
    message.style.marginTop = "30px";
    message.style.fontWeight ="bold"; // Add margin-top to the text content
    box.appendChild(message);

    // Create an "OK" button
    var okButton = document.createElement('button');
    okButton.textContent = "OK";
    okButton.style.marginTop = "20px";
    okButton.style.padding ="5px 15px";
    okButton.style.backgroundColor ="#F18D65";
    okButton.style.borderRadius ="5px";
     // Add margin-top to the button

    // Add event listener to remove the box when OK is clicked
    okButton.addEventListener('click', function() {
        document.body.removeChild(box);
        window.location.href = "receipt.php";

    });

    // Append the OK button to the box
    box.appendChild(okButton);

    // Style the box
    box.style.backgroundColor = "#ffffff"; // Background color
    box.style.color = "#000000"; // Text color
    box.style.width = "300px"; // Width of the box
    box.style.height = "auto"; // Height of the box will adjust based on content
    box.style.border = "2px solid #000000"; // Border
    box.style.borderRadius = "10px"; // Border radius
    box.style.position = "fixed"; // Position fixed to stay in the middle
    box.style.top = "50%"; // Position from top
    box.style.left = "50%"; // Position from left
    box.style.transform = "translate(-50%, -50%)"; // Center the box horizontally and vertically
    box.style.textAlign = "center";
    box.style.padding = "20px"; // Add padding to the box

    // Append the box to the body of the HTML document
    document.body.appendChild(box);
}

// Call the displayBox function after 10 seconds
setTimeout(displayBox, 10000);
