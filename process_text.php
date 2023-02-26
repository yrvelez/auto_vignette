<?php

$experiment_text = 'prompt: a study about whether safety or freedom affects attitudes->completion: {\"treatment\": \"Numerous courts have ruled that the U.S. Constitution ensures that the Klan has the right to speak and hold rallies on public grounds, and that individuals have the right to hear the Klan\'s message if they are interested. Many of the Klan\'s appearances in the state have been marked by violent clashes between Klan supporters and counter demonstrators who show up to protest the Klan\'s racist activities. In one confrontation last October, several bystanders were injured by rocks thrown by Klan supporters and protesters. Usually, a large police force is needed to control the crowds.<br><br>Opinion about the speech and rally is mixed. Many students, faculty, and staff worry about the rally, but support the group\'s right to speak. Clifford Strong, a professor in the law school, remarked, \"I hate the Klan, but they have the right to speak, and people have the right to hear them if they want to. We may have some concerns about the rally, but the right to speak and hear what you want takes precedence over our fears about what could happen.\"\",
\"control\": \"Numerous courts have ruled that the U.S. Constitution ensures that the Klan has the right to speak and hold rallies on public grounds, and that individuals have the right to hear the Klan\'s message if they are interested. Many of the Klan\'s appearances in the state have been marked by violent clashes between Klan supporters and counterdemonstrators who show up to protest the Klan\'s racist activities. In one confrontation last October, several bystanders were injured by rocks thrown by Klan supporters and protesters. Usually, a large police force is needed to control the crowds.<br><br>Opinion about the speech and rally is mixed. Many students, faculty, and staff have expressed great concern about campus safety and security during a Klan rally. Clifford Strong, a professor in the law school, remarked, \"Freedom of speech is important, but so is the safety of the OSU community and the security of our campus. Considering the violence at past KKK rallies, I don\'t think the University has an obligation to allow this to go on. Safety must be our top priority.\"}';
$experiment_text2 = 'prompt: experiment about deservingness and welfare->completion: {\"treatment\": \"Imagine a man who is currently on social welfare. He has always had a regular job, but has now been the victim of a work-related injury. He is very motivated to get back to work again.\",
\"control\": "Imagine a man who is currently on social welfare. He has never had a regular job, but he is fit and healthy. He is not motivated to get a job."}';
$experiment_text3 =  'prompt: study about low-skilled vs. high-skilled immigrants->completion: {\"treatment\": \"Do you agree or disagree that the US
should allow more low skilled immigrants from other countries to come and live here?\", \"control\": \"Do you agree or disagree that the US should allow more highly skilled immigrants from other countries to come and live here?\"}';
$experiment_text4 = 'prompt: how do people evaluate governors vs presidents->completion: {\"treatment\": \"Suppose there has been a lot of economic growth this year. To what extent do you think the governor can take credit for this growth?\", \"control\": \"Suppose there has been a lot of economic growth this year. To what extent do you think the president can take credit for this growth?\"}';
$experiment_text5 = 'prompt:  experiment about intentional trade and job security->completion: {\"treatment\": \"The United States is considering a trade policy that would have the following effects: For each 1,000 people in the U.S. who gain a job and can now provide for their family, 10 people in a country that we trade with will gain new jobs and now be able to provide for their family.\", \"control\": \"The United States is considering a trade policy that would have the following effects: For each 10 people in the U.S. who gain a job and can now provide for their family, 1000 people in a country that we trade with will lose jobs and will no longer be able to provide for their family.\"}';
$experiment_text6 = 'prompt:  experiment about whether polarization causes more polarization->completion: {\"treatment\": \"<b>Electorate as Divided as Ever:</b> A new study of American voters after the 2020 presidential election, based on interviews, showed how Republicans and Democrats have different views on social issues and the economy. The study also reveals a huge gap in approval ratings for Biden between the parties, which reflects the fundamental divides in the country.", \"control\": \"<b>Electorate Remains Moderate:</b> A new study of American voters after the 2020 presidential election, based on interviews, showed how Republicans and Democrats have similar views on social issues and the economy. The study also reveals a small gap in approval ratings for Biden between the parties, which reflects the shared values in the country.\"}';

$text_input = $_POST['text_input'];
$api_key = $_POST['api_key'];
  
  $endpoint = 'https://api.openai.com/v1/completions';
  
  $headers = array(
  'Content-Type: application/json',
  'Authorization: Bearer ' . $api_key);
  
  $data = array(
  'model' => 'text-davinci-003',
  'prompt' => 'Produce two experimental conditions that relate to the prompt' . 
  'This is a two-arm survey experiment used in political science'. 
  'It should look like a paragraph from a newspaper. For example:' .
    $experiment_text . '<br><br>' . $experiment_text2 . '<br><br>' .
    $experiment_text3 . '<br><br>' . $experiment_text4 . '<br><br>' .
    $experiment_text5 . '<br><br>' . $experiment_text6 . '<br><br>prompt:' .
    $text_input . '->completion:',
   'temperature' => .85,
   'max_tokens' => 600,
   'stop' => ["<br><br>"]
  );
  
  $ch = curl_init($endpoint);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $complete = curl_exec($ch);
  curl_close($ch);
  
 $result = str_replace("", "", json_decode($complete, true)['choices'][0]['text']);
    $result = stripslashes($result);
    $result = str_replace(array('[',']') , '', $result);
    $result = trim($result, '"');
    echo json_encode($result);

?>
