//habp - ddcc

function getBusinessDatesCount(startDate, endDate) {
    var count = 0;
    var curDate = startDate;
    curDate.setHours(19);
    endDate.setHours(18);
    while (curDate < endDate) {
        curDate.setDate(curDate.getDate() + 1);        
        var dayOfWeek = curDate.getDay();
        if(!esFeriado(curDate)){
            if(!((dayOfWeek == 6) || (dayOfWeek == 0)))
                count++;
            };        
    }
    return count;
}
function getBusinessDatesSum(startDate, num) {
    var count = 1;
    var curDate = startDate;
    while (count <= num) {
        curDate.setDate(curDate.getDate() + 1);
        var dayOfWeek = curDate.getDay();
        if(!esFeriado(curDate)){
        if(!((dayOfWeek == 6) || (dayOfWeek == 0))){
           count++;
            }
          }
        }
    return curDate;
}
function cadenaDate(date){
    var Dia=date.getDate();
    var Mes=(date.getMonth()+1);
    var Anio=date.getFullYear();
    var cadena="";
    if(Dia<10){cadena="0"+Dia+"/";}else{cadena=Dia+"/";};
    if (Mes<10) {cadena=cadena+"0"+Mes+"/";}else{cadena=cadena+Mes+"/";};
    cadena=cadena+Anio;
    return cadena;
}

function esFeriado(dateseacrh)
{
    var Esferiado=false;
    var feriado1=new Date('11-01-2017');
    var feriado2=new Date('11-16-2017');
    var feriado3=new Date('12-08-2017');
    var feriado4=new Date('12-25-2017');
    var feriado5=new Date('01-01-2018');
    var feriados=[feriado1,feriado2,feriado3,feriado4,feriado5];
    for (var i = feriados.length - 1; i >= 0; i--) {
        //---------------
        var fechaBuscar=cadenaDate(dateseacrh);
        //------------
        var feriadoS=cadenaDate(feriados[i]);
        //-----------------
        if (fechaBuscar==feriadoS) {
            Esferiado=true;
        }
    }
    return Esferiado;
}
function listaFechaString(stringDate){
    var Fecha=new Date(stringDate);
    var Dia=Fecha.getDate();
    var Mes=(Fecha.getMonth()+1);
    var Anio=Fecha.getFullYear();
    var tiempo=(Anio*365)+(Mes*31)+Dia;
    return tiempo;    
}
function listaFecha(Datess){
    var Dia=Datess.getDate();
    var Mes=(Datess.getMonth()+1);
    var Anio=Datess.getFullYear();
    var tiempo=(Anio*365)+(Mes*31)+Dia;
    return tiempo;    
}
function diasVencimiento(tipo,dias){
    var nrodias=0;

    if (tipo=='PMA') {nrodias=10;}else
    if (tipo=='CIRA') {nrodias=20;}else
    if (tipo=='Levantamiento Obs. CIRA' || tipo=='Reingreso CIRA') {nrodias=20;nrodias=nrodias-dias;}else
    if (tipo=='Levantamiento Obs. PMA' || tipo=='Reingreso PMA') {nrodias=10;nrodias=nrodias-dias;}else
    {nrodias=30;}
    if (nrodias<0) {nrodias=0;}
    return nrodias;
}
//10-12
function diasVencimientoPEA(tipo,dias){
    var nrodias=0;

    if (tipo=='PEA') {nrodias=30;}else
    if (tipo=='Levantamiento Obs. PEA' || tipo=='Reingreso PEA') {nrodias=30;nrodias=nrodias-dias;}else
    {nrodias=30;}
    if (nrodias<0) {nrodias=0;}
    return nrodias;
}
//Cusco