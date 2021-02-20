window.onload = () => {
  let xmlhttpcli = new XMLHttpRequest();
  var d = new Date();
  var uzi =  d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()
  var n = d.getDay();
  let evenementst = {
      "title":"",
      "start": uzi + " 08:00:00",
      "end": uzi + " 18:00:00",
      "display" : "background",
      "backgroundColor" : "black",

  };

  xmlhttpcli.onreadystatechange = () => {
    if(xmlhttpcli.readyState == 4){
      if(xmlhttpcli.status == 200){
      }}}
      xmlhttpcli.open("GET","sessionE.php",true);
      xmlhttpcli.send(null);
      console.log(xmlhttpcli);
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = () => {
        if(xmlhttp.readyState == 4){
          if(xmlhttp.status == 200){
            let evenements = JSON.parse(xmlhttp.responseText);
            let client = JSON.parse(xmlhttpcli.responseText);
            evenements.push(client);
            evenements.push(evenementst);

            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {

              firstDay: n,
              editable: false,
              expandRows: true,
              headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
              },
              validRange: function(nowDate) {
                return {
                  start: nowDate,
                };},

                buttonText:{
                  today : 'Aujourd\'hui',
                  week : 'Semaines',
                  day: 'Jours',
                },
                initialView: 'timeGridWeek',
                hiddenDays: [ 0, 6 ],
                selectable: true,
                selectMirror: true,
                allDaySlot: false,
                slotMinTime: "08:00:00",
                slotMaxTime: "18:00:00",
                slotDuration: "01:00:00",
                locale: 'fr',
                selectOverlap: function(event) {
                },
                events : evenements,
                select: function(arg) {
                  clienteventsession = calendar.getEventById( "client" );
                  clientID= clienteventsession.title;
                  if (calendar.getEventById( clientID) == null) {
                    var title = prompt('Motif:');
                    function appendLeadingZeroes(n){
                      if(n <= 9){
                        return "0" + n;
                      }
                      return n
                    }
                    let formatted_datestart = arg.start.getFullYear() + "-" + appendLeadingZeroes(arg.start.getMonth() + 1) + "-" + appendLeadingZeroes(arg.start.getDate()) + " " + appendLeadingZeroes(arg.start.getHours()) + ":" + appendLeadingZeroes(arg.start.getMinutes()) + ":" + appendLeadingZeroes(arg.start.getSeconds())
                    let formatted_dateend = arg.start.getFullYear() + "-" + appendLeadingZeroes(arg.start.getMonth() + 1) + "-" + appendLeadingZeroes(arg.start.getDate()) + " " + appendLeadingZeroes(arg.start.getHours()+1) + ":" + appendLeadingZeroes(arg.start.getMinutes()) + ":" + appendLeadingZeroes(arg.start.getSeconds())
                    if (title) {
                      let test = {
                        id: clientID,
                        title: title,
                        start: formatted_datestart,
                        end: formatted_dateend,
                        url:clienteventsession.url,
                        editable : false,
                      }
                      calendar.setOption('selectable', false);
                      calendar.addEvent(test)
                    }
                  }
                  calendar.unselect()
                },
                customButtons: {
                  valider: {
                    text: 'Valider réservation',
                    click: function() {
                      clienteventsession = calendar.getEventById( "client" );
                      clientID= clienteventsession.title;
                      if (calendar.getEventById( clientID ) == null) {
                        alert('Veuillez choisir une date');
                      }else {
                        if (confirm('Êtes vous sur de votre choix ?')) {
                          var evenementchoisi = calendar.getEventById( clientID )
                          function appendLeadingZeroes(n){
                            if(n <= 9){
                              return "0" + n;
                            }
                            return n
                          }
                          let formatted_datestart = evenementchoisi.start.getFullYear() + "-" + appendLeadingZeroes(evenementchoisi.start.getMonth() + 1) + "-" + appendLeadingZeroes(evenementchoisi.start.getDate()) + " " + appendLeadingZeroes(evenementchoisi.start.getHours()) + ":" + appendLeadingZeroes(evenementchoisi.start.getMinutes()) + ":" + appendLeadingZeroes(evenementchoisi.start.getSeconds())
                          let formatted_dateend = evenementchoisi.end.getFullYear() + "-" + appendLeadingZeroes(evenementchoisi.end.getMonth() + 1) + "-" + appendLeadingZeroes(evenementchoisi.end.getDate()) + " " + appendLeadingZeroes(evenementchoisi.end.getHours()) + ":" + appendLeadingZeroes(evenementchoisi.end.getMinutes()) + ":" + appendLeadingZeroes(evenementchoisi.end.getSeconds())
                          let req = new XMLHttpRequest
                          let reservation ={
                            ID_PERSONNEMORALE: clientID,
                            RES_DATEDEBUT: formatted_datestart,
                            RES_DATEFIN: formatted_dateend ,
                            RES_MOTIF: evenementchoisi.title,
                            RES_URL: evenementchoisi.url,
                          }
                          req.open("POST","api-rest/reservation/creerE.php",true);
                          req.send(JSON.stringify(reservation))
                          console.log(req);
                          window.location.href = "reservation.php";

                        }
                      }
                    }
                  },
                  annuler: {
                    text: 'Annuler selection',
                    click: function() {
                      clienteventsession = calendar.getEventById( "client" );
                      clientID= clienteventsession.title;
                      if (calendar.getEventById( clientID ) == null) {
                        alert('Aucune date n\'a été selectionnée');
                      }else {
                        calendar.getEventById(clientID).remove() ;
                        calendar.setOption('selectable', true);
                      }
                    }
                  }
                },
                footerToolbar:{
                  right : 'valider',
                  left : 'annuler',
                },
              });
              calendar.render();
}}}
      xmlhttp.open("GET","api-rest/reservation/lireC.php",true);
            xmlhttp.send(null);
            console.log(xmlhttp);
          }
