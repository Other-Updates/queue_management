
if( 'function' === typeof importScripts) {
   importScripts('http://demo.f2fsolutions.co.in/queue_management/themes/queue/speak/speakGenerator.js');
   addEventListener('message', onMessage);

   function onMessage(event) { 
      postMessage(generateSpeech(event.data.text, event.data.args));
   }    
}