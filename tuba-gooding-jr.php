<?php
$buddy = $argv[1];
$message = $argv[2];
$badBuddies = array('buddyname1', 'buddyname2');

if (in_array($buddy, $badBuddies)) {
	// does it have a youtube link?
	if (preg_match("/(?:www\.)?(?:youtube.com|youtu.be)\/(?:([\w-]{11})|watch\?v=([\w-]{11}))/", $message, $matches)) {
		// grab the video info
		$comments = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . $matches[count($matches) - 1] . '/comments');

		// pick a random one
		$idx = rand(0, 25);

		$comment = $comments->entry[$idx]->content;

		// if it's a reply, find another. limit the loop to 25 tries
		$count = 0;
		while (stristr($comment, '@') && $count < 25) {
			$oldIdx = $idx;
			while ($oldIdx == $idx) {
				$idx = rand(0, 25);
			}

			$comment = $comments->entry[$idx]->content;
			$count++;
		}

		echo $comment;
		return 1;
	}
}

echo 'no';
return 1;
?>