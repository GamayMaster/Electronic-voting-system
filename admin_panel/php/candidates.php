<!DOCTYPE html>
<html>
  <head>
    <style>
      body {
        margin: 0;
        padding: 0;
        background-color: darkgray;
        background-size: cover;
      }

      .navbar {
        background-color: #333;
        overflow: hidden;
        font-family: Arial, sans-serif;
        padding: 20px;
      }

      .navbar a {
        float: left;
        color: #fff;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }

      .navbar a:hover {
        background-color: #ddd;
        color: #333;
      }

      .navbar a.active {
        background-color: #fff;
        color: #333;
      }
      .navbar .right {
        float: right;
      }

      h1 {
        text-align: center;
        color: #0a66c2;
        font-family: "Courier New", Courier, monospace;
        font-size: 4vw;
        text-decoration: underline;
        text-shadow: 3px 3px 3px black;
      }

      .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
      }

      .card {
        width: 300px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 10px;
        padding: 20px;
      }

      .card img {
        width: 100%;
        border-radius: 5px;
        margin-bottom: 10px;
      }

      .card h3 {
        text-align: center;
        margin-bottom: 5px;
      }

      .card p {
        text-align: center;
        margin-bottom: 20px;
      }

      .card button {
        display: block;
        margin: 0 auto;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <
    <div class="navbar">
      <a class="active" href="index.html">الصفحة الرئيسية</a>
      <a href="candidates.html">المرشحون</a>
      <a href="voting.html">التصويت</a>
      <a href="result.html">النتائج</a>
      <a href="add.html">اضافة مرشح</a>
      <a href="log_in.html" class="right">تسجيل الدخول</a>
    </div>
    <h1>
      Welcome To :<br />
      Technology In Democracy
    </h1>

    <div class="container">
      <div class="card">
        <img
          src="169409580_2881391108778415_5160552275248693427_n.jpg"
          alt="صورة المرشح 1" />
        <h3>اسم المرشح 1</h3>
        <p>تفاصيل إضافية عن المرشح 1</p>
        <button>المزيد من التفاصيل</button>
      </div>
      <div class="card">
        <img
          src="169409580_2881391108778415_5160552275248693427_n.jpg"
          alt="صورة المرشح 2" />
        <h3>اسم المرشح 2</h3>
        <p>تفاصيل إضافية عن المرشح 2</p>
        <button>المزيد من التفاصيل</button>
      </div>
      <div class="card">
        <img
          src="169409580_2881391108778415_5160552275248693427_n.jpg"
          alt="صورة المرشح 3" />
        <h3>اسم المرشح 3</h3>
        <p>تفاصيل إضافية عن المرشح 3</p>
        <button>المزيد من التفاصيل</button>
      </div>
    </div>
  </body>
</html>
