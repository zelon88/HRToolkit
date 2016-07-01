4/9/2016

Justin G.

www.HonestRepair.net
Cloud.HonestRepair.net

--HRAI Version 0.5--

PURPOSE: To experiment with AI, statistical relational learning, application-layer load-balancing,
 automated scalar networks, de-centralized Cloud computing, and general computer language and 
 computational-though experiments.

PROGRESS: As of this point HRAI can ALMOST completely network itself with other servers on a local 
 network, or with minimal configuration network itself with other servers on external networks. 
 This will come in handy for concurrent research and learning functions for later, and for sharing
 resources across multiple machines regardless of individual server capabilities or performance. 
 The core generates sesID's, cache files, and log files accordingly. Some of these files cannot
 be automatically be readjusted. All of these files MUST be either owned by the www-data user and
 a member of the www-data group, or have permissions set to 777 (not reccomended). The LangPar 
 currently splits up user inputs and simplifies the string down. It also creates arrays for the 
 different types of input (sentences, fragments) and attempts to generate a unique "WordHash" for 
 each word. This hash is unique to the word, but easily identifies the word to any HRAI node, with
 contect intact. Also currently present is a few starter words for the database that layout the 
 basic format HRAI will use to hash words and sentences. Eventually we will incorporate machine 
 reading, learning, and databasing into the LangPar process. It's important to note that LangPar
 WILL NOT be just some early 2000's chat-bot. It will actually take into account over 25x variables
 unique to each word and the sentence it's contained in and parse that down into a satisfiable, 
 quantifiable value for our machine to do something with. However, the Core currently acts as a 
 basic virtual-intelligence if you will. Give it an input like "Hello HRAI, please tell me the
 date" and it will politely comply with a response that matches your own. It will also execute
 multiplle commands in one text input. For example, "Hello HRAI, please tell me the time and 
 scan a file for viruses" will give you a response containing the time, and the HRScan iframer.
 Another example, "reload nodecache tell me the time convert a file" will reload the nodeCache,
 tell you the time, and give you an iFramer to convert a file. "CallForHelp" and a variety of
 synonyms currently work to test various methods for offloading data, although there's not much
 to offload at this point. 

REQUIREMENTS: 1) PHP 5.5 or later on an Apache or Nginx server environment. No MySQL required! 
				2) Curl plugin for PHP.
				3) PHP must be configured with all timeouts increased to at least 2000 seconds.
				4) PHP must be configured to allow file-uploads over 2 MB.
				5) PHP must be configured to allow an unlimited number of VARS.
				6) /HRAI/sesLogs directory owned by www-data, 0755.
				   -IF ANY OF THESE REQUIREMENTS ARE UNMET YOU WILL EXPERIENCE UN-LOGGED ERRORS!!
				OPTIONAL) Have WordPress installed AND configured. This will require MySQL, but
				  will enable advanced admin and user functions.

GOALS: Long-Term: To have fun, experiment, and learn about programming. Also, to learn as much about 
 statistical-relational learning and to eventually implement that into an open-source platform
 that anyone could develop plugins for. Maybe someday HRAI could become the WordPress of AI, 
 enabling developers from around the word to test new theories and develop their code on a super
 forgiving, infinitely scaling, and inherintly secure environment. 
 Short-Term: 1) Furthur develop the LanguageParser. Add more words to the database and test the format
 and feasibility of the word/sentence hash format for parsing language. 2) See if "solving" a sentence
 hash is possible, and try to come up with algorithms that offload research functions to third-party 
 nodes to possibly dynamically create machine-generated words. 3) Continue GUI development. Find a use 
 for all that space. 4) Add support for speech recognition. 5) Continue to test/fix/develop the 
 functions relating to adding/refreshing/specifying nodes within the nodeCache. Develop a better
 solution. 6) ADD MORE CORE COMMANDS!!! 7) Test alternate WordPress detection method on production 
 server and see which methor works best. This package contains method A. We believe method B works
 better.

THOUGHTS: 
 The way HRAI is developed, it will automatically try to locate and cache 9x nodes whenever
 it's busy. In theory, if we had 81x servers, we could POST data to one and get a response from another
 one that we've never directly sent any data to before. This de-centrilized method for handling user 
 "sessions" is one that essentially "slices" the session among separate nodes. Each node that partakes
 in a session has a slice of the session on file, but only the origin node will contain a complete
 copy of the session. This could maybe prove useful as an application-layer load-balancer, where a 
 session needs to be maintained by multiple scripts across multiple servers without a user having
 to load each script. Essentially the origin node processes what it can and POSTS out the overflow
 to it's available nodeCache. Those servers process what they can and POST their overflow to their
 available nodeCache. The cycle goes on and on and on, until eventually we're holding a conversation
 with a machine about the Spanish Inquisition and it's reading the Wiki articles just as fast as we 
 can give it search terms. This concurrency will play a vital role in achieving sentience, as any 
 advanced thing can only do so much if it can't walk and chew gum at the same time. 

 The way the LanguageParser works is by taking in a user input, and breaking it into sentences. Each 
 sentence is broken out into words, and each word is plugged into a filter which uses the words around it
 to try and detect the structure and meaning of the overall sentence. We do this by parsing each word one 
 at a time and attaching variables to it, then mushing each into a unique sentence hash and passing it back
 through our filter. We then look at the meta the sentence hash generates and try to counter it, or add
 it to our sesID (which serves as the servers short-term memory, while the sesDir is the long-term memory).
 Either way, we need to "satisfy" every segment of this sentence hash. Whether that be with an action, a
 "thought", or a response, we cannot just "preg_match" everything to a static array and call it AI.

