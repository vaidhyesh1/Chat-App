# Cluster Chat Application
## INTRODUCTION
There are numerous products available that allow for real time “chatting” over the Internet.
The purpose of this project is to implement a multi-platform based chat application that will allow users with an internet connection to engage in private and public conversations.
The development of this project centered on the development of a message protocol that would allow the application to properly log in users, send messages, and manage groups and profile.
This project is to create a chat application with a server and clients to enable the clients to chat with many other clients in the same common chat group.
## GOALS OF THE PROJECT
Communication: To develop an instant messaging solution to enable users to seamlessly communicate with each other.
User friendliness: The project should be very easy to use enabling even a novice person to use it.
## INNOVATIVE IDEAS OF PROJECT
GUI: Easy to use GUI (Graphical User Interface), hence any user with minimal knowledge of operating a system can use the software.
Platform independence: The messenger operates on any system irrelevant of the underlying operating system.
Unlimited clients: number of users can be connected without any performance degradation of the server.
## INTERFACE
This application interacts with the user through G.U.I. The interface is simple , easy to handle and self-explanatory.
Once opened, user will easily come into the flow with the application and easily uses all interfaces properly.
However the basic interface available in our application is
* Title panel
* Content panel
* Profile panel.
### HARDWARE INTERFACE
* Minimum requirements :
    * 128 MB RAM required.
    * Processor with speed of 500 MHz.
    * Internet or LAN connection.
    * Keyboard
    * Smartphone /pc
### SOFTWARE INTERFACE
* Notepad++ is a text editor and source code editor and provides an environment for developing HTML, jsp, JavaScript many other editing purposes.
* Coding done in java so required JDK 1.4 and above for run java programs.
* Operating system (such as window 7, 8, xp, Linux etc).
## CONSTRAINTS
The application does not by any means open the web browser. If user wishes to open the web browser he must open it externally.
The system need to be permanent connected with internet.
Clients should know each other.
## FUNCTIONAL REQUIREMENTS
### Login Menu 
This functional requirement is for prompting the user with the option to register for the chat application, logging in, or exit the program. It will take the form of a GUI Register function(APP aspect) : This aspect of the login menu will ask the user for the name, username, and password of the client. It will check if the username has been taken and will close if the username is not taken and will go back to the main login menu.
### Login function(APP aspect) 
This aspect will ask for the username and password. Errors will occur if a space is left blank, the username doesn’t exist, or the password doesn’t match with the username. If the username and password matches, you are online and able to message anyone else online.
### Exit(APP aspect)
This aspect will close the chat application. Online Menu function This function will give the option of seeing who is online, the option of sending a message to whoever is online, and the option to logout. Send a message: This aspect will give the user the ability to send a message to whoever they want who is online and selected by the user. 
### Logout(Online Menu aspect)
This aspect will give the option to logout of the chat application and will go back to the login menu..
### Broadcast Message
User should be able to create groups of contacts. User should be able to broadcast messages to these groups. Message Status : User must be able to get information on whether the message sent has been read by the intended recipient. 
## NON FUNCTIONAL  REQUIREMENTS
### Scalability 
CHAT App should be able to provide instant messaging services to all users at any given time.
### Privacy 
Messages shared between users should be encrypted to maintain privacy. (not possible because we aren’t able to host a server)
### Robustness 
In case user’s device crashes, a backup of their chat history must be stored on remote database servers to enable recoverability.
### Performance 
Application is extremely lightweight and sends messages instantly.
