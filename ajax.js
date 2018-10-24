                $(document).ready(function(){
                
                 $.ajax({url: "https://classicdb.ch?item=14555",
                         dataType: "json",
                         crossDomain: true}).done(function( data ){
                                                    alert(123);
                                                  });
                });