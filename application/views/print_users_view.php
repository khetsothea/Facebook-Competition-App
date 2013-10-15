<table class="table table-striped">  
    <thead>  
        <tr>  
            <th>Name</th> 
            <th>User Id </th>
            <th>Age</th>  
            <th>Email</th>  
            <th>College</th>  
        </tr>  
    </thead>  
    <tbody>  

        <?php foreach ($users as $persons) { ?>
            <tr>  
                <td><a href="<?php echo $persons->link; ?>" target="_blank"> <?php echo $persons->name; ?></a> </td>
                <td><?php echo $persons->id; ?> </td>
                <td><?php echo $persons->age; ?> </td>
                <td><?php echo $persons->email; ?> </td>
                <td><?php echo $persons->college; ?> </td>

            </tr>  
        <? } ?>
    </tbody>


