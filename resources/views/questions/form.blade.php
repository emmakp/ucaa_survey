<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      padding-top: 50px;
    }
    .survey-form {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .rating {
      display: flex;
      flex-direction: row-reverse;
      justify-content: center;
    }
    .rating input {
      display: none;
    }
    .rating label {
      position: relative;
      width: 1em;
      font-size: 3rem;
      color: #FFD700;
      cursor: pointer;
    }
    .rating label::before {
      content: "\2605";
      position: absolute;
      opacity: 0;
    }
    .rating label:hover::before,
    .rating label:hover ~ label::before {
      opacity: 1 !important;
    }
    .rating input:checked ~ label::before {
      opacity: 1;
    }
    .rating input:checked ~ label:hover::before,
    .rating input:checked ~ label:hover ~ label::before,
    .rating label:hover ~ input:checked ~ label::before {
      opacity: 0.4;
    }
    .checkbox-bordered input[type="checkbox"] {
      appearance: none;
      background-color: #fff;
      border: 1px solid #ced4da;
      padding: 9px;
      border-radius: 3px;
      display: inline-block;
      position: relative;
      margin-right: 10px;
    }
    .checkbox-bordered input[type="checkbox"]:checked {
      background-color: #007bff;
      border: 1px solid #007bff;
    }
    .checkbox-bordered input[type="checkbox"]:checked:after {
      content: "\f00c";
      font-family: "FontAwesome";
      font-size: 10px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
    }
    .form-group-range {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="survey-form">
    <h2 class="text-center mb-4">Survey Form</h2>
    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" class="form-control" id="dob" required>
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender" required>
          <option value="">Select</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" rows="3" placeholder="Enter your address" required></textarea>
      </div>
      <div class="form-group">
        <label for="services">Which services did you use?</label>
        <div class="checkbox-bordered">
          <label><input type="checkbox" name="services" value="cctv"> CCTV Installation</label>
          <label><input type="checkbox" name="services" value="alarm"> Alarm Systems</label>
          <label><input type="checkbox" name="services" value="intercom"> Door Intercoms</label>
          <label><input type="checkbox" name="services" value="fence"> Electric Fences</label>
        </div>
      </div>
      <div class="form-group">
        <label for="rating">Rate our service</label>
        <div class="rating">
          <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"></label>
          <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"></label>
          <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"></label>
          <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"></label>
          <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
        </div>
      </div>
      <div class="form-group form-group-range">
        <label for="satisfaction">Overall Satisfaction</label>
        <input type="range" class="form-control-range" id="satisfaction" min="0" max="100">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
