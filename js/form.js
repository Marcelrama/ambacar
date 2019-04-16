$(function(){
  $("#update_profile_submit").on("click", function(){
    var nombre250 = $('#nombre_250').val();
    var dx3 = $('#dx3').val();
    var t600 = $('#t600').val();
    var swmx7 = $('#swmx7').val();
    var z360 = $('#z360').val();
    var x390 = $('#x390').val();
    var x30l = $('#x30l').val();
    var li750 = $('#li750').val();
    var t50 = $('#t50').val();
    var t52 = $('#t52').val();
    var phone = $('#phone').val();
    var email = $('#email').val();
    var surquillo = $('#surquillo').val();
    var plazaNorte = $('#plaza-norte').val();
    var santaAnita = $('#santa-anita').val();
    var sanMiguel = $('#san-miguel').val();
    var sjm = $('#sjm').val();
    var arequipa = $('#arequipa').val();
    var huancayo = $('#huancayo').val();
    

    var profileData = {
      nombre250,
      dx3,
      t600,
      swmx7,
      z360,
      x390,
      x30,
      li750,
      t50,
      t52,
      phone,
      email,
      surquillo,
      plazaNorte,
      santaAnita,
      sanMiguel,
      sjm,
      arequipa,
      huancayo,
      form: "contact form about page", // use this to filter in Zapier
      listserve: profileListserve ? true : false,
    };

    // Submit Contact Form on AboutUS
    bowtie.user.profile(profileData, function(){
      alert("Gracias por contactarnos. Nos pondremos en contacto pronto.");
    });
    return false;
  });
});

