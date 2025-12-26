import MainLayout from "@/layouts/MainLayout";
import HeroSection from "@/components/organisms/HeroSection";
import { motion } from "framer-motion";
import { Link } from "react-router-dom";
import { ArrowRight } from "lucide-react";
import { projects } from "@/data/projects";
import { blogPosts } from "@/data/blog";
import ProjectCard from "@/components/molecules/ProjectCard";
import BlogCard from "@/components/molecules/BlogCard";

const Index = () => {
  const featuredProjects = projects.filter(p => p.featured).slice(0, 3);
  const featuredPosts = blogPosts.filter(p => p.featured).slice(0, 2);

  return (
    <MainLayout>
      <HeroSection />

      {/* Featured Projects Preview */}
      <section className="py-24 bg-surface-elevated">
        <div className="container mx-auto px-6">
          <div className="flex items-center justify-between mb-10">
            <div>
              <h2 className="text-2xl md:text-3xl font-heading font-bold text-foreground mb-2">
                Featured Work
              </h2>
              <p className="text-muted-foreground">Selected projects I'm proud of</p>
            </div>
            <Link to="/projects">
              <motion.div
                className="flex items-center gap-2 text-primary font-medium"
                whileHover={{ x: 4 }}
              >
                View all
                <ArrowRight size={18} />
              </motion.div>
            </Link>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {featuredProjects.map((project, index) => (
              <ProjectCard key={project.id} project={project} index={index} />
            ))}
          </div>
        </div>
      </section>

      {/* Recent Blog Posts Preview */}
      <section className="py-24 bg-background">
        <div className="container mx-auto px-6">
          <div className="flex items-center justify-between mb-10">
            <div>
              <h2 className="text-2xl md:text-3xl font-heading font-bold text-foreground mb-2">
                Recent Thoughts
              </h2>
              <p className="text-muted-foreground">Writings and reflections</p>
            </div>
            <Link to="/blog">
              <motion.div
                className="flex items-center gap-2 text-primary font-medium"
                whileHover={{ x: 4 }}
              >
                View all
                <ArrowRight size={18} />
              </motion.div>
            </Link>
          </div>

          <div className="space-y-6 max-w-3xl">
            {featuredPosts.map((post, index) => (
              <BlogCard key={post.id} post={post} index={index} />
            ))}
          </div>
        </div>
      </section>

      {/* Quick CTA */}
      <section className="py-24 bg-card">
        <div className="container mx-auto px-6">
          <motion.div
            className="max-w-2xl mx-auto text-center"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            <h2 className="text-3xl md:text-4xl font-heading font-bold text-foreground mb-4">
              Let's work together
            </h2>
            <p className="text-muted-foreground text-lg mb-8">
              Have a project in mind? I'd love to hear about it.
            </p>
            <Link to="/contact">
              <motion.button
                className="inline-flex items-center gap-2 px-8 py-4 bg-primary text-primary-foreground font-medium rounded-full hover:shadow-lg transition-shadow"
                whileHover={{ scale: 1.02 }}
                whileTap={{ scale: 0.98 }}
              >
                Get in touch
                <ArrowRight size={18} />
              </motion.button>
            </Link>
          </motion.div>
        </div>
      </section>
    </MainLayout>
  );
};

export default Index;
