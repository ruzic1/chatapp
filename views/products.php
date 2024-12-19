<?php
    include_once('fixedParts/header.php');
    //$userInfo=$_GET['userId'];
?>
<script>
</script>
<style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      height: 100vh;
    }

    .container1 {
      display: flex;
      width: 100%;
      height:100%;
    }
    .containerHeader{
        display: flex;
      width: 100%;
    }
    #listOfContacts{
      width: 20%;
      background-color: #f0f0f0;
      border-right: 1px solid #ddd;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
    }

    .contact {
      padding: 15px;
      cursor: pointer;
      border-bottom: 1px solid #ddd;
    }

    .contact:hover {
      background-color: #eaeaea;
    }

    .messages {
      flex: 1;
      display: flex;
      flex-direction: column;
      background-color: #ece5dd;
    }

    .message-area {
      flex: 1;
      padding: 15px;
      overflow-y: auto;
    }

    .message {
      margin-bottom: 10px;
      padding: 10px;
      max-width: 70%;
      border-radius: 10px;
      word-wrap: break-word;
    }

    .sent {
      background-color: #dcf8c6;
      align-self: flex-end;
    }

    .received {
      background-color: #fff;
      align-self: flex-start;
    }

    .input-area {
      padding: 10px;
      border-top: 1px solid #ddd;
      background-color: #fff;
      display: flex;
    }

    .input-area input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin-right: 10px;
    }

    .input-area button {
      padding: 10px 20px;
      background-color: #075e54;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .input-area button:hover {
      background-color: #064c46;
    }
</style>
    <div class="containerHeader">
        <h1 id='currentUser'><?=$_SESSION['username']?></h1>
    </div>
    <div class="container1">
        
        <div id="listOfContacts">
        <!-- <div class="contact">John Doe</div>
        <div class="contact">Jane Smith</div>
        <div class="contact">Mike Johnson</div> -->
        </div>
        <div class="messages">
        <div id="message-area">
            <!-- <div class="message sent">Hi there!</div>
            <div class="message received">Hello! How are you?</div>
            <div class="message sent">I'm good, thanks. And you?</div> -->
        </div>
        <div class="input-area">
            <input type="text" placeholder="Type a message" id='msgText'>
            <button id='buttonForSendingMessage'>Send</button>
        </div>
        </div>
    </div>
<?php
    include_once('fixedParts/footer.php');
?>