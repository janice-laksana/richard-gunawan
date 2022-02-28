import { gql } from "@apollo/client";

export const LOAD_REPOSITORIES = gql`
  query loadRepositories{
    user(login: "richardgunawan26") {
      id
      repositories(first: 10) {
        edges {
          node {
            id
            description
            name
            url
            stargazerCount
          }
        }
      }
    }
  }
`;

export const LOAD_REPOSITORIY = gql`
  query loadRepository($id: ID!){
    node(id: $id) {
      ... on Repository {
        id
        description
        nameWithOwner
        name
        url
        issues(first: 10) {
          edges {
            node {
              id
            }
          }
        }
      }
    }
  }
`;