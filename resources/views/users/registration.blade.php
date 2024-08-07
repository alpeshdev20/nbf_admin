<style>
body {
  background: #f7f7f7;
}

.form-box {
  max-width: 500px;
  margin: auto;
  padding: 50px;
  background: #ffffff;
  border: 10px solid #f2f2f2;
}

h1, p {
  text-align: center;
}

input, textarea {
  width: 100%;
}
</style>
<div class="form-box">
  <h1>Simple Contact Form</h1>
  <p>Using <a href="https://getbootstrap.com">Bootstrap</a> and <a href="https://www.formbucket.com">FormBucket</a></p>
  <form action="https://api.formbucket.com/f/c2K3QTQ" method="post">
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" type="text" name="Name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" id="email" type="email" name="Email">
    </div>
    <div class="form-group">
      <label for="message">Message</label>
      <textarea class="form-control" id="message" name="Message"></textarea>
    </div>
    <input class="btn btn-primary" type="submit" value="Submit" />
    </div>
  </form>
</div>