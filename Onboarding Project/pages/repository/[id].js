import Head from "next/head";
import Image from "next/image";
import Link from 'next/link'
import styles from "../../styles/Home.module.css";
import { useRouter } from 'next/router'

import {
  useMutation,
  useQuery,
} from "@apollo/client";
import { useEffect, useState } from "react";
import { STAR_REPO, SUBSCRIBE_REPO, UNSTAR_REPO, UNSUBSCRIBE_REPO } from "../../GraphQL/Mutations";
import { LOAD_REPOSITORIES, LOAD_REPOSITORIY } from "../../GraphQL/Queries";
import { ToastContainer, toast } from 'react-toastify';
import Parser from 'html-react-parser';

const DetailRepository = () => {
  const [repository, setRepository] = useState()
  const [issues, setIssues] = useState([])
  const router = useRouter()
  const { id } = router.query
  const { error, loading, data } = useQuery(LOAD_REPOSITORIY, {
    variables: {
      id: id,
    },
  });
  if (error) return `Error! ${error}`;
  
  const onCompletedStar = (data) => {
    const payload = data.addStar.starrable;
    const newStargazerCount = payload.stargazerCount;
    if(newStargazerCount === repository.stargazerCount) {
      toast.warning("Already starred", {autoClose: 2000})
    } else {
      toast.success("Starred", {autoClose: 2000})
    }
  }
  const onCompletedUnstar = (data) => {
    const payload = data.removeStar.starrable;
    const newStargazerCount = payload.stargazerCount;
    if(newStargazerCount === repository.stargazerCount) {
      toast.warning("Already unstarred", {autoClose: 2000})
    } else {
      toast.success("Unstarred", {autoClose: 2000})
    }
  }

  const onCompleteSubscribe = (data) => {
    console.log('onCompleteSubscribe', data);
    toast.success("Subscribed", {autoClose: 2000})
  }

  const onCompleteUnsubscribe = (data) => {
    console.log('onCompleteUnsubscribe', data);
    toast.success("unsubscribed", {autoClose: 2000})
  }
  
  const [starRepo, { errorStarRepo }] = useMutation(STAR_REPO, {
    onCompleted: onCompletedStar,
  });
  const [unstarRepo, { errorUnstarRepo }] = useMutation(UNSTAR_REPO, {
    onCompleted: onCompletedUnstar,
  });
  const [subscribeRepo, { errorSubsribeRepo }] = useMutation(SUBSCRIBE_REPO, {
    onCompleted: onCompleteSubscribe,
  });
  const [unsubscribeRepo, { errorUnsubscribeRepo }] = useMutation(UNSUBSCRIBE_REPO, {
    onCompleted: onCompleteUnsubscribe,
  });


  useEffect(() => {
    if (data) {
      const { node } = data;
      const repo = node;
      setRepository(repo);

      const { issues } = repo;
      issues = issues.edges.map((issue) => {
        return {
          ...issue.node,
          comments: issue.node.comments.edges.map((comment) => comment.node),
        }
      });

      setIssues(issues);
    }
  }, [data]);

  const onStar = async (repo_id) => {
    starRepo({
      variables: {
        starrableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        addStar: {
          __typename: "AddStarPayload",
          starrable: {
            __typename: "Repository",
            id: repo_id,
            stargazerCount: repository.stargazerCount + 1,
            viewerHasStarred: !(repository.viewerHasStarred)
          },
        },
      }
    });
    if (errorStarRepo) console.log(errorStarRepo);
  }

  const onUnstar = async (repo_id) => {
    unstarRepo({
      variables: {
        starrableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        removeStar: {
          __typename: "RemoveStarPayload",
          starrable: {
            __typename: "Repository",
            id: repo_id,
            stargazerCount: repository.stargazerCount - 1,
            viewerHasStarred: !(repository.viewerHasStarred)
          },
        },
      }
    });
    if (errorUnstarRepo) console.log(errorUnstarRepo);
  };

  const onSubscribe = async (repo_id) => {
    subscribeRepo({
      variables: {
        subscribableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        updateSubscription: {
          __typename: "UpdateSubscriptionPayload",
          subscribable: {
            __typename: "Repository",
            viewerSubscription: repository.viewerSubscription == 'SUBSCRIBED' ? 'UNSUBSCRIBED' : 'SUBSCRIBED',
          },
        },
      },
      update: (proxy, data) => {
        const newSubscription = data.data.updateSubscription.subscribable.viewerSubscription;
        let objNewRepo = {...repository, viewerSubscription: newSubscription};
        setRepository(objNewRepo);
      }
    });
  }
  const onUnsubscribe = async (repo_id) => {
    unsubscribeRepo({
      variables: {
        subscribableId: String(repo_id),
      },
      optimisticResponse: {
        __typename: "Mutation",
        updateSubscription: {
          __typename: "UpdateSubscriptionPayload",
          subscribable: {
            __typename: "Repository",
            viewerSubscription: repository.viewerSubscription == 'UNSUBSCRIBED' ? 'SUBSCRIBED' : 'UNSUBSCRIBED',
          },
        },
      },
      update: (proxy, data) => {
        const newSubscription = data.data.updateSubscription.subscribable.viewerSubscription;
        let objNewRepo = {...repository, viewerSubscription: newSubscription};
        setRepository(objNewRepo);
      }
    });
  }

  return (
    <div className={styles.container}>

      <Head>
        <title>Richard Gunawan Onboarding Project</title>
        <meta name="description" content="GDP Labs Frontend Onboarding Project" />
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <main className={styles.main}>
        <button className="btn btn-secondary btn-sm" type="button" onClick={() => router.back()}>
          ??? Click here to go back
        </button>
        <h1 className={styles.title}>
          Github Detail Page
        </h1>

        <h3>Repository</h3>
        <div className={styles.carddetail}>
          {repository && !repository.viewerHasStarred && <button onClick={() => onStar(repository && repository.id)} className="btn btn-warning mx-1">Star</button>}
          {repository && repository.viewerHasStarred && <button onClick={() => onUnstar(repository && repository.id)} className="btn btn-danger mx-1">Unstar</button>}
          
          {repository && repository.viewerSubscription == 'UNSUBSCRIBED' && <button onClick={() => onSubscribe(repository.id)} className="btn btn-primary mx-1">Subscribe</button>}
          {repository && repository.viewerSubscription == 'SUBSCRIBED' && <button onClick={() => onUnsubscribe(repository.id)} className="btn btn-secondary mx-1">Unsubscribe</button>}

          <a target={"_blank"} href={repository && repository.url} className="btn btn-success mx-1">Github Page</a>
          <h2>{repository && repository.nameWithOwner}</h2>
          {repository && <span className={'badge rounded-pill ' + (repository.viewerSubscription == 'SUBSCRIBED' ? 'bg-success' : 'bg-danger')}>{repository.viewerSubscription}</span>}
          <p>{repository && repository.description}</p>
          <p>???? {repository && repository.stargazerCount}</p>
          <p>Issues : {(repository && repository.issues.edges.length) ?? '-'}</p>
        </div>
        <div style={{width: '1000px'}}>
          <h4>List Issues : </h4>
          {issues.length == 0 && <p>No Issues</p>}
          {issues.length > 0 && issues.map((issue) => {
            const badgeStatus = issue.closed == false ? <span className="badge rounded-pill bg-success">Open</span> : <span className="badge rounded-pill bg-danger">Closed</span>;

            return (
              <div key={issue.id} className="card my-2">
                <div className="card-header">
                  <span style={{marginRight: 10}}><img src={issue.author.avatarUrl} width={30} /></span>
                  <span>{issue.author.login}</span>
                </div>
                <div className="card-body">
                  <h5 className="card-title">{issue.title} {badgeStatus}</h5>
                  <p>Created At : {issue.createdAt}</p>
                  <p><button className="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target={'#collapse'+issue.id} aria-expanded="false" aria-controls={'collapse'+issue.id}>Open Detail</button></p>
                  <div className="collapse" id={'collapse'+issue.id}>
                    <div className="card card-body">    
                      <div className="bodyHtml">{Parser(issue.bodyHTML)}</div>
                      <span>Comments : </span>
                      {issue.comments.map((comment) => {
                        return (
                          <ul key={comment.id} className={styles.comments}>
                            <li>{comment.author.login} : {comment.body}</li>
                          </ul>
                        )
                      })}
                    </div>
                  </div>
                </div>
              </div>
            )
          })}
        </div>

      </main>
      <ToastContainer />
    </div>
  );
}

export default DetailRepository