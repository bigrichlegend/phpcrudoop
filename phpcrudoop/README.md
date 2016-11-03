To install the demo
Clone to desktop the files
import records.sql in phpmyadmin
run index.php from local server


Updated insert and delete functions but now needs to further update
the buildQuery function to differentiate between insert ot delete or 
update statements. This is becoming unwieldy and so a structural change
might be better such as :

putting the helper functions in a separate file

putting insert, delete function in own class 

This will take a little longer than required.
