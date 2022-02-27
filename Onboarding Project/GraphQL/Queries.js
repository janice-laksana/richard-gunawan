import { gql } from "@apollo/client";

export const LOAD_REPOSITORIES = gql`
  {
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
