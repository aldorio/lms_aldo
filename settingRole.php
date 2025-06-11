<?php 
    function group1()
    {
      // instruktur
      return ['4'];
    }

    function group2()
    {
      // students
      return ['6'];
    }

    function group3()
    {
      // 2: admin 3:PIC 5:administrators
      return ['2','3','5'];
    }
    function role_available()
    {
      // 4: instruktur, 6:students
      return['4','6'];
    }

    // in_array
    function canAddModul($role)
    {
      if(in_array($role, group1())){
        return true;
      }
    }
?>