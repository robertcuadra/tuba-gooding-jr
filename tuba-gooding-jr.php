<?php
$buddy = $argv[1];
$message = $argv[2];
$badBuddies = array('buddyhandle1', 'buddyhandle2');

if (in_array($buddy, $badBuddies)) {
	// does it have a youtube link?
	if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=[0-9]/)[^&\n]+|(?<=v=)[^&\n]+#", $message, $matches)) {
		// grab the video info
		$comments = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . $matches[0] . '/comments');

		// pick a random one
		$idx = rand(0, 25);

		$comment = $comments->entry[$idx]->content;

		// if it's a reply, find another
		if (stristr($comment, '@')) {
			$oldIdx = $idx;
			while ($oldIdx == $idx) {
				$idx = rand(0, 25);
			}

			$comment = $comments->entry[$idx]->content;
		}

		echo $comment;
		return 1;
	}
}

echo 'no';
return 1;
?>