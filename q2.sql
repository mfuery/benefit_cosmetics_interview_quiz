-- If you just want to get the pokemon where 3 players have that pokemon (and get their player_id's)
SELECT
  GROUP_CONCAT(player_id SEPARATOR ',') AS player_ids,
  pokemon_id,
  count(1)                              AS n_players
FROM stats
GROUP BY pokemon_id
HAVING n_players = 3;

-- If you want the names of the player (and their pokemon) for sets of 3, then:
SELECT
  player_name,
  pokemon_name
FROM
  (
    SELECT
      player.name  AS                                                 player_name,
      pokemon.name AS                                                 pokemon_name,
      substring_index(t.player_ids, ',', 1)                           player_id_1,
      substring_index(substring_index(t.player_ids, ',', -2), ',', 1) player_id_2,
      substring_index(substring_index(t.player_ids, ',', -1), ',', 1) player_id_3
    FROM (
           SELECT
             GROUP_CONCAT(player_id SEPARATOR ',') AS player_ids,
             pokemon_id,
             count(1)                              AS n_players
           FROM stats
           GROUP BY pokemon_id
           HAVING n_players = 3
         ) t
      INNER JOIN player
        ON player.id = substring_index(t.player_ids, ',', 1)
           OR player.id = substring_index(substring_index(t.player_ids, ',', -2), ',', 1)
           OR player.id = substring_index(substring_index(t.player_ids, ',', -1), ',', 1)
      INNER JOIN pokemon
        ON pokemon.id = t.pokemon_id
    GROUP BY player_name, pokemon_name
    ORDER BY pokemon_name, player_name
  ) t2
GROUP BY player_name, pokemon_name
;
