import { gql } from "@apollo/client";

export const LOAD_REPOSITORIES = gql`
  query {
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
  query($repoName: String!){
    user(login: "richardgunawan26") {
      repository(name: $repoName) {
        id
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