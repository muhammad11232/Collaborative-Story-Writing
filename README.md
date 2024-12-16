Laravel Developer Practical Test Description
Objective:
Build a Collaborative Story Writing Platform that allows users to contribute to shared stories in real-time. The platform should provide functionalities for story creation, collaboration, and tracking individual contributions, enabling users to actively participate in a collaborative writing experience.

Project Description:
The Collaborative Story Writing Platform will enable users to create and collaborate on stories by contributing chapters. The platform will track each user's contributions and rank them based on their total word count. The system will be built using Laravel, leveraging its powerful built-in features such as authentication, migrations, relationships, seeders, and job queues. The platform's main features include user authentication, story creation, collaborative writing, ranking of contributors, and asynchronous notification handling.

Features to Implement:
1. User Registration and Authentication:
Implement Laravel's built-in authentication system to allow users to register and log in.
Only registered users should be able to create or contribute to stories.
The authentication system should include login, registration, password recovery, and user session management.
2. Database Design:
Use Laravel migrations to create and manage the necessary database tables for:
Users: Store user information and credentials.
Stories: Store information about the stories, including the title, description, and creator.
Chapters: Store individual chapters contributed by users, along with word count and contributor details.
Contributions: Track the word count of each user’s contributions to the chapters.
Define appropriate relationships between the models (e.g., one-to-many relationship between stories and chapters).
Implement database seeders to populate the database with initial or test data, such as sample stories, chapters, and users.
3. Core Features:
3.1 Story Creation:

Users should be able to create new stories and add the first chapter.
Validation:
Ensure the story title is unique and required.
The description should be optional but must not exceed 500 characters.
3.2 Collaborative Writing:

Registered users can add chapters to existing stories.
Each chapter should include the user ID of the contributor for tracking purposes.
Track the word count of each contribution and save it in the contributions table.
3.3 Ranking System:

Display a leaderboard showing the top contributors based on their total word count.
The ranking system should update in real-time as users add chapters.
3.4 Notifications:

Notify the story creator whenever a new chapter is added to their story.
Notify a contributor if their chapter is edited or removed by the story creator.
3.5 Moderation:

Story creators have the ability to:
Publish or unpublish a story.
Edit or delete any chapter in their story.
