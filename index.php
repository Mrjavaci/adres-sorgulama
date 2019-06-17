<html>
<head></head>
<body>

<div class="bilgi"></div>
<div class="currentAdres"></div>

<select class="form-control" id="ilListesi"></select><br/>
<select class="form-control" id="ilceListesi"></select><br/>
<select class="form-control" id="mahalleKoyBaglisiListesi"></select><br/>
<select class="form-control" id="yolListesi"></select><br/>
<select class="form-control" id="binaListesi"></select><br/>
<select class="form-control" id="bagimsizBolumListesi"></select>


<script>
  var dizi = ["ilListesi", "ilceListesi", "mahalleKoyBaglisiListesi", "yolListesi", "binaListesi", "bagimsizBolumListesi"];

  function yazdir() {
    $(".currentAdres").html("");
    $(".adres").text("");
    for (let i = 0; i < dizi.length; i++) {
      $(".currentAdres").append($("#" + dizi[i] + " option:selected ").text() + " / ");
    }
    for (let i = 0; i < dizi.length; i++) {
      $(".adres").text($("#" + dizi[i] + " option:selected ").text() + " / ");
    }
  }

  function selectSistemi() {
    var form = new FormData();
    form.append("url", "ilListesi");
    $(".bilgi").html("Bağlanılıyor....");
    sorgula(form);

    $('#ilListesi').on('change', function () {
      let index = this.value;
      var form2 = new FormData();
      form2.append("url", "ilceListesi");
      form2.append("postKey", "ilKimlikNo");
      form2.append("postValue", index);
      sorgula(form2);
      yazdir();
    });
    $('#ilceListesi').on('change', function () {
      let index = this.value;
      var form3 = new FormData();
      form3.append("url", "mahalleKoyBaglisiListesi");
      form3.append("postKey", "ilceKimlikNo");
      form3.append("postValue", index);
      sorgula(form3);
      yazdir();

    });
    $('#mahalleKoyBaglisiListesi').on('change', function () {
      let index = this.value;
      var form3 = new FormData();
      form3.append("url", "yolListesi");
      form3.append("postKey", "mahalleKoyBaglisiKimlikNo");
      form3.append("postValue", index);
      sorgula(form3);
      yazdir();

    });
    $('#yolListesi').on('change', function () {
      let index = this.value;
      let postValue2 = $(this).find(':selected').attr('postValue2');

      console.log(postValue2);
      var form3 = new FormData();
      form3.append("url", "binaListesi");
      form3.append("postKey", "mahalleKoyBaglisiKimlikNo");
      form3.append("postValue", index);
      form3.append("postKey2", "yolKimlikNo");
      form3.append("postValue2", postValue2);
      sorgula(form3);
      yazdir();

    });

    $('#binaListesi').on('change', function () {
      let index = this.value;
      let postValue2 = $(this).find(':selected').attr('postValue2');

      console.log(postValue2);
      var form3 = new FormData();
      form3.append("url", "bagimsizBolumListesi");
      form3.append("postKey", "mahalleKoyBaglisiKimlikNo");
      form3.append("postValue", index);
      form3.append("postKey2", "binaKimlikNo");
      form3.append("postValue2", postValue2);
      sorgula(form3);
      yazdir();

    });
  }

  function disableEt(isim) {
    var bulundu = false;
    for (let i = 0; i < dizi.length; i++) {
      if (bulundu) {
        document.getElementById(dizi[i]).disabled = true;
      }
      if (dizi[i] === isim) {
        bulundu = true;
      }
    }
  }

  function ayarla(url, response) {
    $(".bilgi").html("Bağlanıldı.");
    var jsonObjesi = JSON.parse(response);
    let urlWithTag = "#" + url;
    $(urlWithTag).html("");
    for (var i = 0; i < jsonObjesi.length; i++) {
      var obj = jsonObjesi[i];
      switch (url) {
        case "ilceListesi":
        case "ilListesi" :
        case "mahalleKoyBaglisiListesi" :
          $(urlWithTag).append($('<option>', {
            value: obj["kimlikNo"],
            text: obj["adi"],
          }));
          break;
        case "yolListesi" :
        case "binaListesi" :
          $(urlWithTag).append($('<option>', {
            value: obj["mahalleKayitNo"],
            text: obj["bilesenAdi"],
            postValue2: obj["kimlikNo"],
          }));
          break;
        case "bagimsizBolumListesi":
          $(urlWithTag).append($('<option>', {
            value: obj["mahalleKayitNo"],
            text: obj["bilesenAdi"],
            postValue2: obj["kimlikNo"],
          }));
          break;
      }
    }

  }

  function sorgula(form) {
    console.log(form.get("url"));
    $(".bilgi").html("Bağlanılıyor...");


    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "adresSorgu.php",
      "method": "POST",
      "processData": false,
      "contentType": false,
      "mimeType": "multipart/form-data",
      "data": form
    };

    $.ajax(settings).done(function (response) {
      ayarla(form.get("url"), response);
    });
    $.post()
  }
</script>
</body>
</html>