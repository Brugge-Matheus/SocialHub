Estrutura Banco de dados
--Users
-id
-email
-password
-name
-birthdate
-city
-work
-avatar
-cover
-token

--UserRalations
-id
-user_from
-user_to

--Posts
-id
-type (text, foto)
-created_at
-body

--PostsComments
-id
-id_post
-id_user
-created_at
-body

--PostLikes
-id
-id_post
-id_user
-created_at
