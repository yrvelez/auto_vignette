This PHP script is designed to generate survey experiments using OpenAI's GPT-3 language model. The script takes a text input and an API key as input, and returns a two-arm survey experiment.

**How to Use**

Clone this repository to your local machine or fork it to your own GitHub account.
Upload the script to your server or run it locally using a PHP server.

The script generates survey experiments using a two-arm design, with a treatment condition and a control condition. The prompt for the experiment is specified in the text_input parameter of the POST request. The script uses "few shot learning" with six examples drawn from political science, which are stored in the $experiment_text to $experiment_text6 variables.

The completed survey experiment is generated using OpenAI's GPT-3 API. The max_tokens and temperature parameters of the model can be adjusted to control the length and creativity of the generated text.

**Dependencies**

This script requires PHP and the cURL library to be installed on the server. Additionally, an API key for OpenAI's GPT-3 language model is required to use the script.

**Working Demo**

A working demo can be found <a href="https://tailoredexperiments.com/auto_vignette/">here</a>.
