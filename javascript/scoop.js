function adjustImage(pic){
	var w = pic.offsetWidth;
	if (w > 319) {
		//force to big
		jQuery(pic).parents(".post").addClass("center").addClass("big");
	}
}

