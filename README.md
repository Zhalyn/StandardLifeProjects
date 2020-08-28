# StandardLifeProjects
During the summer of 2020 up to the end of September, I interned as a software engineer at Standard Life, a life insurance company in Almaty, Kazakhstan. Throughout the duration of summer, I worked on two web applications individually - Journal Archive and Standard Life Home. 

# JournalArchive 
The first project I worked on was an archive for all insurance data simply called - Standard Life Journal Archive. The archive represents itself an internal website for Almaty's main campus to search up crucial client data by the SL's insurance agents. Technologies used: HTML, CSS, JavaScript, PHP, JQuery, OracleSQL. 

![JournalArchive](https://github.com/Zhalyn/StandardLifeProjects/blob/master/JournalArchive/JournalArchive.png)

# Key Features
The webpage is made up of several components: a search bar, an HTML table and an Excel convertor. First of all, for an efficient data search and to prevent data overflow, any word inputted through a search bar is sent by a request to an internal Oracle database using PHP. If accepted, data requested will be parsed on an HTML table generated using a JavaScript method. The user has five options to search through which are essential components of each insurance document: Insurance Agent, Journal ID, Date Signed, Inital Date and Final Date. For each component, seperate PHP files were developed. Secondly, I implemented a scripted HTML table that forms columns around each parsed data. Finally, in order to convert an HTML table and its contents, a JavaScript method was implemented tied to an HTML button which automatically downloads an Excel file. 

# StandardLifeHome
Standard Life Home is a webpage for SL's clients to check on their insurance data (payment deadlines, insurance agent contact info., etc.). The project is not complete yet but most of the components such as data parsing from a db and login/registration system are already implemented. Technologies used: HTML, CSS, JavaScript, PHP, JQuery, OracleSQL.

# Key Features
In order to authenticate each user entering the website, a simple login/registration system, with PHP supproing data authentication through a database, was developed. Each client's relevant information is tied to their individual identification number (similiar to social security number), so typing that data is required in order to register into the system. In home.php (the webpage itself), similiar to JournalArchive, each individuals data is parsed onto an HTML table displaying them to the users. 
