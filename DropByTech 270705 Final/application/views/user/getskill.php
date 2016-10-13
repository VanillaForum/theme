<?php
    $skills = get_skill($this->session->userdata['user_data']['id']);
    if(!empty($skills)){
        foreach ($skills as $skill)
        {
?>   
        <span id="skill_<?php echo $skill->id; ?>"><?php echo $skill->skill;?>
            &nbsp;&nbsp;<a href="javascript:void(0)" rel="<?php echo $skill->id; ?>" class="remove_skill"> X</a>
        </span>
<?php            
        }
    }
?>