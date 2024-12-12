<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div
      style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2"
    >
      <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #ec8f5e">
          <a
            href=""
            style="font-size:3.0em;color: #DA6E35;text-decoration:none;font-weight:600"
            >GLUBLOOD</a
          >
        </div>

        <div>
          <h1 style="font-size:2.0em">Kode Verifikasi</h1>
        </div>

        <p>Hi, glublooders</p>
        <p>
          Kami telah menerima permintaan pengiriman kode verifikasi atas
          pendaftaranmu!
        </p>
        <p>
          Terimakasih telah mendaftarkan dirimu ke dalam aplikasi Glublood!
          Untuk melanjutkan aplikasi kami harap untuk memasukkan kode dibawah
          ini
        </p>

        <br />
        <div style="display: flex">
          <h1
            style="margin: auto; background: #DA6E35; padding: 0 20px;color: #fff;border-radius: 4px; justify-content: center; align-content: center"
          >
            {{$verificationCode}}
          </h1>
        </div>
        <br />
        <p style="color: #969696">*Kode ini akan berlaku selama 3 menit</p>

        <p style="font-size:0.9em;">Salam sehat,<br />Tim Glublood</p>
        <hr style="border:none;border-top:1px solid #eee" />

        <div
          style="float:left;padding:8px 0;color:#aaa;font-size:1.8em;line-height:1;font-weight:300"
        >
          <p>Glublood</p>
          <p>Jakarta</p>
        </div>
      </div>
    </div>
  </body>
</html>
