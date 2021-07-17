import "./index.scss"
import {useSelect} from "@wordpress/data"


wp.blocks.registerBlockType("newplugin/reacts", {
  title: "Reacts",
  description: "Description",
  icon: "star-filled",
  category: "common",
  attributes:{
    postId:{type:"string"}
  },
  edit: EditComponent,
  save: function () {
    return null
  }
})

function EditComponent(props) {

  

  // First-Step get Data of All Posts From Database
  const allPosts=useSelect(select=>{
    return select("core").getEntityRecords("postType","block",{per_page:-1})
  })


  if (allPosts==undefined) return <p>Loading...</p>

  return (
    <div >
      <div  >
       
       <select onChange={e => props.setAttributes({postId: e.target.value }) } >
         <option>Select Post:</option>
         
         {allPosts.map(post=>{
           return(
            <option  value={post.id} selected={props.attributes.postId==post.id}>{post.title.rendered}</option>
           )
         })}
       </select>
      </div>
      <div>
        Preview
      </div>      
    </div>
  )
}