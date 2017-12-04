“ENORMOUS XML”


You have 100GB well-formed XML-file which contains “Users” table dump. The structure of the file:

~~~xml
<users>
<user>
<id>10</id>
<name>User One</name>
<email>user@mail.com</mail>
...
<age>35</age>
...
</user>
<user>
...
</user>
...
</users>
~~~

Write command-line PHP script which will process this file and filter out all users of age 20 to 30 years.
The output should be stored in another file. Do not use XML parser libraries.
