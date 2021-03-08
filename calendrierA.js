


window.onload = () => {
    let xmlhttp = new XMLHttpRequest()
    var d = new Date();
    var n = d.getDay();
    xmlhttp.onreadystatechange = () => {
        if(xmlhttp.readyState == 4){
            if(xmlhttp.status == 200){
                let evenements = JSON.parse(xmlhttp.responseText);
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        firstDay: n,
         expandRows: true,
      headerToolbar: {
        left: 'prev,next,today',
        center: 'title',
        right: 'timeGridWeek,timeGridDay,dayGridMonth'

      },
      buttonText:{
        today : 'Aujourd\'hui',
        week : 'Semaines',
        day: 'Jours',
        month:'Mois',
      },
      initialView: 'timeGridWeek',
      hiddenDays: [ 0, 6 ],
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      allDaySlot: false,
      slotMinTime: "08:00:00",
      slotMaxTime: "18:00:00",
      slotDuration: "01:00:00",
      locale: 'fr',


      select: function(arg) {
              var title = prompt('Motif:');
              if (title) {

                function appendLeadingZeroes(n){
                  if(n <= 9){
                    return "0" + n;
                  }
                  return n
                }
                let req = new XMLHttpRequest()
                let formatted_datestart = arg.start.getFullYear() + "-" + appendLeadingZeroes(arg.start.getMonth() + 1) + "-" + appendLeadingZeroes(arg.start.getDate()) + " " + appendLeadingZeroes(arg.start.getHours()) + ":" + appendLeadingZeroes(arg.start.getMinutes()) + ":" + appendLeadingZeroes(arg.start.getSeconds())
                let formatted_dateend = arg.end.getFullYear() + "-" + appendLeadingZeroes(arg.end.getMonth() + 1) + "-" + appendLeadingZeroes(arg.end.getDate()) + " " + appendLeadingZeroes(arg.end.getHours()) + ":" + appendLeadingZeroes(arg.end.getMinutes()) + ":" + appendLeadingZeroes(arg.end.getSeconds())
                let evenement = {
                  title: title,
                  start: arg.start,
                  end: arg.end,
                  allDay: arg.allDay
                }
                let reservation = {
                  ID_ADMIN: 1 ,
                  RES_DATEDEBUT:formatted_datestart,
                  RES_DATEFIN:formatted_dateend,
                  RES_MOTIF:title,
                }
                req.onreadystatechange = () => {
                  if(req.readyState == 4){
                    if(req.status == 201){
                      console.log(req);
                      calendar.addEvent(evenement)
                    }}}
                req.open("POST","api-rest/reservation/creerA.php",true);
                req.send(JSON.stringify(reservation))


              }
              calendar.unselect()
            },

            eventClick: function(arg) {
           if (confirm('Voulez vous supprimer cette réservation?')) {
             let reqdelete = new XMLHttpRequest()
             let reservationdel={
               ID_RESERVATION: arg.event.id,
             }
             reqdelete.onreadystatechange = () => {
               if(reqdelete.readyState == 4){
                 if(reqdelete.status == 200){
                   console.log(reqdelete);
                   arg.event.remove()
                 }}}
             reqdelete.open("DELETE","api-rest/reservation/supprimer.php",true);
             reqdelete.send(JSON.stringify(reservationdel))

           }
         },


      events : evenements,
      nowIndicator: true,
      editable: true,




    });

    calendar.render();

}}}

xmlhttp.open("GET","api-rest/reservation/lireA.php",true);
xmlhttp.send(null)
console.log(xmlhttp);


}
