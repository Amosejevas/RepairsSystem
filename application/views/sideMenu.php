<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                Repair center
            </a>
        </li>
        <li>
            <a href="/RepairsController/register">Register repair</a>
        </li>
        <li>
            <a href="/RepairsController/myRepairs">My repairs</a>
        </li>
        <?php 
           $role = $this->User->getUserRole($this->session->userdata('username'));
           if( $role == 'Repairman'){
                echo
            '<li>
                <a href="#">Repairman info</a>
            </li>';
           };
        ?>
      
        <li>
            <a href="#">About</a>
        </li>
        <li>
            <a href="#">Contacts</a>
        </li>
    </ul>
</div>